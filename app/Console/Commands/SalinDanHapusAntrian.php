<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Antrian;
use App\Models\Riwayat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalinDanHapusAntrian extends Command
{
    protected $signature = 'antrian:salin-dan-hapus';
    protected $description = 'Salin data antrian selesai ke riwayat dan hapus data yang sudah disalin dari antrian';

    public function handle()
    {
        Log::info('Memulai proses salin dan hapus antrian...');
        
        DB::beginTransaction();

        try {
            // Ambil semua data antrian yang statusnya selesai
            $antrians = Antrian::where('status', 'selesai')->get();
            Log::info('Jumlah antrian selesai ditemukan: ' . $antrians->count());

            if ($antrians->isEmpty()) {
                DB::commit();
                Log::info('Tidak ada data antrian dengan status selesai untuk disalin.');
                $this->info('Tidak ada data antrian dengan status selesai untuk disalin.');
                return 0;
            }

            $idAntrianHapus = [];
            $jumlahDisalin = 0;
            $jumlahGagal = 0;

            foreach ($antrians as $antrian) {
                try {
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
                            'status'         => $antrian->status,
                            'karyawan_id'    => $antrian->karyawan_id,
                            'created_at'     => $antrian->created_at,
                            'updated_at'     => $antrian->updated_at,
                        ]);

                        $idAntrianHapus[] = $antrian->id_antrian;
                        $jumlahDisalin++;
                        Log::debug("Berhasil menyalin antrian ID: {$antrian->id_antrian}");
                    }
                } catch (\Exception $e) {
                    $jumlahGagal++;
                    Log::error("Gagal menyalin antrian ID: {$antrian->id_antrian} - " . $e->getMessage());
                }
            }

            // Hapus data antrian yang sudah disalin ke riwayat
            if (!empty($idAntrianHapus)) {
                $deleted = Antrian::whereIn('id_antrian', $idAntrianHapus)->delete();
                Log::info("{$deleted} data antrian berhasil dihapus");
            }

            DB::commit();

            $message = "Proses selesai. {$jumlahDisalin} data berhasil disalin, {$jumlahGagal} gagal.";
            Log::info($message);
            $this->info($message);

            return 0;

        } catch (\Exception $e) {
            DB::rollBack();
            $errorMsg = 'Gagal menyalin dan menghapus data antrian: ' . $e->getMessage();
            Log::error($errorMsg);
            $this->error($errorMsg);
            return 1;
        }
    }
}