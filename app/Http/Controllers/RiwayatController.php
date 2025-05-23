<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Karyawan;
use App\Models\Antrian;  // Pastikan import model Antrian
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\RiwayatExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class RiwayatController extends Controller
{
    /**
     * Tampilkan daftar riwayat dengan filter search, tanggal, dan karyawan.
     */
    public function index(Request $request)
    {
        $karyawans = Karyawan::all();

        $query = Riwayat::with('karyawan');

        if ($request->filled('search')) {
            $query->where('nama_pelanggan', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_selesai);
        }

        if ($request->filled('karyawan_id')) {
            $query->where('karyawan_id', $request->karyawan_id);
        }

        $riwayats = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('riwayats.index', compact('riwayats', 'karyawans'));
    }

    /**
     * Salin semua data antrian dengan status 'selesai' ke tabel riwayat dan hapus data antrian yang berhasil disalin.
     */
    public function salinDataSelesai()
    {
        DB::beginTransaction();

        try {
            $antrians = Antrian::where('status', 'selesai')->get();

            if ($antrians->isEmpty()) {
                DB::commit();
                return redirect()->route('riwayats.index')
                    ->with('info', 'ℹ️ Tidak ada data antrian dengan status selesai untuk disalin.');
            }

            $idAntrianHapus = [];
            $jumlahDisalin = 0;

            foreach ($antrians as $antrian) {
                $exists = Riwayat::where('id_antrian', $antrian->id_antrian)->exists();

                if (!$exists) {
                    Riwayat::create([
                        'id_antrian'     => $antrian->id_antrian,
                        'nomor_antrian'  => $antrian->nomor_antrian,
                        'nama_pelanggan' => $antrian->nama_pelanggan,
                        'no_wa'          => $antrian->no_wa,
                        'jenis_mobil'    => $antrian->jenis_mobil,
                        'nomor_plat'     => $antrian->nomor_plat,
                        'harga'          => $antrian->harga,
                        'jenis_layanan'  => $antrian->jenis_layanan,
                        'status'         => $antrian->status,
                        'karyawan_id'    => $antrian->karyawan_id,
                        'created_at'     => $antrian->created_at,
                        'updated_at'     => $antrian->updated_at,
                    ]);

                    $idAntrianHapus[] = $antrian->id_antrian;
                    $jumlahDisalin++;
                }
            }

            if (!empty($idAntrianHapus)) {
                Antrian::whereIn('id_antrian', $idAntrianHapus)->delete();
            }

            DB::commit();

            if ($jumlahDisalin > 0) {
                return redirect()->route('riwayats.index')
                    ->with('success', '✅ ' . $jumlahDisalin . ' data antrian selesai berhasil disalin dan dihapus.');
            } else {
                return redirect()->route('riwayats.index')
                    ->with('info', 'ℹ️ Tidak ada data baru yang disalin.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyalin data ke riwayat: ' . $e->getMessage());

            return redirect()->route('riwayats.index')
                ->with('error', '❌ Gagal menyalin data antrian.');
        }
    }

    /**
     * Pencarian realtime untuk riwayat (misalnya untuk fitur autocomplete).
     */
    public function search(Request $request)
    {
        $keyword = $request->query('query', '');

        $riwayats = Riwayat::with('karyawan')
            ->where('nama_pelanggan', 'like', "%{$keyword}%")
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($riwayats);
    }

    /**
     * Export data riwayat ke file Excel.
     */
    public function export()
    {
        return Excel::download(new RiwayatExport, 'data_riwayat_' . date('Ymd_His') . '.xlsx');
    }
}
