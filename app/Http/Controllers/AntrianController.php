<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Services\WhatsappService; // Pastikan service sudah dibuat dan terdaftar
use Illuminate\Support\Facades\Log;

class AntrianController extends Controller
{
    protected $wa;

    public function __construct(WhatsappService $wa)
    {
        $this->wa = $wa;
    }

    // Menampilkan dashboard
    // public function dashboard()
    // {
    //     $status_dalam_antrian = Antrian::where('status', 'antrian')->count();
    //     $status_dikerjakan    = Antrian::where('status', 'dikerjakan')->count();
    //     $status_selesai       = Antrian::where('status', 'selesai')->count();

    //     $total_hari_ini       = Antrian::whereDate('created_at', today())->sum('harga');
    //     $antrians             = Antrian::with('karyawan')->get();
        
        
    //     // dd($antrians->first()); 
    //     return view('dashboard', compact(
    //         'antrians', 'status_dalam_antrian', 'status_dikerjakan', 'status_selesai', 'total_hari_ini'
    //     ));
    // }
    public function dashboard()
{
    $status_dalam_antrian = Antrian::where('status', 'antrian')->count();
    $status_dikerjakan = Antrian::where('status', 'dikerjakan')->count();
    $status_selesai = Antrian::where('status', 'selesai')->count();
    $total_hari_ini = Antrian::whereDate('created_at', today())->sum('harga');
    
    $antrians = Antrian::with('karyawan')
                ->orderBy('created_at', 'asc')
                ->get();

    return view('dashboard', compact(
        'antrians', 'status_dalam_antrian', 'status_dikerjakan', 
        'status_selesai', 'total_hari_ini', 
    ));
}

    // Menampilkan semua antrian
    public function index()
    {
        $antrians = Antrian::with('karyawan')->get();
        return view('antrian.index', compact('antrians'));
    }

    // Form tambah antrian
    public function create()
    {
        
        $karyawans = Karyawan::all();
        return view('antrian.create', compact('karyawans'));
    }

    // Menyimpan data antrian baru + kirim WA notif (bisa dinonaktifkan dengan komentar)
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'nullable|string|max:255',
            'no_wa'          => 'nullable|string|max:15',
            'jenis_mobil'    => 'required|string|max:255',
            'nomor_plat'     => 'nullable|string|max:20',
            'harga'          => 'required|numeric',
            'jenis_layanan'  => 'required|in:Cuci Full,Cuci Body + Interior,Cuci Body Saja',
            'status'         => 'required|in:antrian,dikerjakan,selesai',
            'karyawan_id'    => 'required|exists:karyawans,id_karyawan',
        ]);

        // Format nomor WA ke +62
        $no_wa = $request->no_wa;
        if (preg_match('/^0/', $no_wa)) {
            $no_wa = preg_replace('/^0/', '+62', $no_wa);
        } elseif (preg_match('/^62/', $no_wa)) {
            $no_wa = '+'.$no_wa;
        }

        $tanggal       = now()->format('dmy');
        $jumlahHariIni = Antrian::whereDate('created_at', today())->count();
        do {
            $urutan          = str_pad($jumlahHariIni + 1, 3, '0', STR_PAD_LEFT);
            $id_antrian_baru = $tanggal . $urutan;
            $jumlahHariIni++;
        } while (Antrian::where('id_antrian', $id_antrian_baru)->exists());

        $antrian = Antrian::create([
            'id_antrian'     => $id_antrian_baru,
            'nomor_antrian'  => $jumlahHariIni,
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_wa'          => $no_wa,
            'jenis_mobil'    => $request->jenis_mobil,
            'nomor_plat'     => $request->nomor_plat,
            'harga'          => $request->harga,
            'jenis_layanan'  => $request->jenis_layanan,
            'status'         => $request->status,
            'karyawan_id'    => $request->karyawan_id,
        ]);

        // ================= WA NOTIF START =================
        
      
        $pesanTambahan = "Kami akan memberi tahu Anda kembali setelah proses pencucian selesai.";

        $components = [[
            'type' => 'body',
            'parameters' => [
                ['type' => 'text', 'text' => $antrian->nama_pelanggan],           // {{1}}
                ['type' => 'text', 'text' => $antrian->jenis_mobil],              // {{2}}
                ['type' => 'text', 'text' => $antrian->nomor_plat],        // {{3}}
                ['type' => 'text', 'text' => $antrian->id_antrian],               // {{4}}
                ['type' => 'text', 'text' => $antrian->status],          // {{5}}
                ['type' => 'text', 'text' => $antrian->harga,], // {{6}}
                ['type' => 'text', 'text' => $pesanTambahan],                     // {{7}}
            ]
        ]];
        

        if (!empty($antrian->no_wa)) {
            $this->wa->sendTemplate(
                $antrian->no_wa,
                'dhutacarwash',
                'en',
                $components
            );
        } else {
            Log::info("Nomor WA kosong, tidak mengirim pesan WA update status untuk antrian ID {$antrian->id_antrian}");
        }
    
        // ================= WA NOTIF END ===================

        return redirect()->route('dashboard')->with('success', 'Antrian berhasil ditambahkan');
    }

    // Update status antrian + WA notif jika selesai (bisa dinonaktifkan dengan komentar)
   public function updateStatus(Request $request, $id_antrian)
    {
    $request->validate([
        'status' => 'required|in:antrian,dikerjakan,selesai',
    ]);

    $antrian = Antrian::where('id_antrian', $id_antrian)->firstOrFail();
    $antrian->status = $request->status;
    $antrian->save();

    // ================= WA NOTIF START =================
  
    // // }
    if (in_array($antrian->status, ['dikerjakan', 'selesai'])) {
        $pesanTambahan = match ($antrian->status) {
            'selesai' => "✅ Kendaraan Anda telah selesai dicuci dan siap diambil. Silakan menuju loket untuk melakukan pembayaran dan pengambilan kendaraan. Terima kasih atas kesabaran dan kepercayaan Anda. 🙏",
            'dikerjakan' => "🔧 Kendaraan Anda sedang dalam proses pencucian. Mohon ditunggu ya 🙏",
            default => "Status kendaraan Anda sedang diproses. Kami akan memberi tahu Anda kembali segera.",
        };
    
        $components = [[
            'type' => 'body',
            'parameters' => [
                ['type' => 'text', 'text' => $antrian->nama_pelanggan],           // {{1}}
                ['type' => 'text', 'text' => $antrian->jenis_mobil],              // {{2}}
                ['type' => 'text', 'text' => $antrian->nomor_plat],        // {{3}}
                ['type' => 'text', 'text' => $antrian->id_antrian],               // {{4}}
                ['type' => 'text', 'text' => $antrian->status],          // {{5}}
                ['type' => 'text', 'text' => $antrian->harga], // {{6}}
                ['type' => 'text', 'text' => $pesanTambahan],                     // {{7}}
            ]
        ]];
        
    
        if (!empty($antrian->no_wa)) {
            $this->wa->sendTemplate(
                $antrian->no_wa,
                'dhutacarwash',
                'en',
                $components
            );
        } else {
            Log::info("Nomor WA kosong, tidak mengirim pesan WA untuk antrian ID {$antrian->id_antrian}");
        }
    }
    // // ================= WA NOTIF END ===================

    return redirect()->route('dashboard')->with('success', 'Status antrian berhasil diperbarui');
}


    // Form edit antrian
    public function edit($id)
    {
        $antrian = Antrian::findOrFail($id);
        $karyawans = Karyawan::all();
        $layanan = ['Cuci Full', 'Cuci Body + Interior', 'Cuci Body Saja'];
        return view('antrian.edit', compact('antrian', 'karyawans', 'layanan'));
        
        
    }

    // Update data antrian (selain status)
    public function update(Request $request, $id_antrian)
    {
        $request->validate([
            'nama_pelanggan' => 'nullable|string|max:255',
            'no_wa'          => 'nullable|string|max:15',
            'jenis_mobil'    => 'required|string|max:255',
            'nomor_plat'     => 'nullable|string|max:20',
            'harga'          => 'required|numeric',
            'status'         => 'required|in:antrian,dikerjakan,selesai',
            'jenis_layanan'  => 'required|in:Cuci Full,Cuci Body + Interior,Cuci Body Saja',
            'karyawan_id'    => 'required|exists:karyawans,id_karyawan',
        ]);

        $antrian = Antrian::where('id_antrian', $id_antrian)->firstOrFail();

        // Format nomor WA
        $no_wa = $request->no_wa;
        if (preg_match('/^0/', $no_wa)) {
            $no_wa = preg_replace('/^0/', '+62', $no_wa);
        } elseif (preg_match('/^62/', $no_wa)) {
            $no_wa = '+'.$no_wa;
        }

        $antrian->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_wa'          => $no_wa,
            'jenis_mobil'    => $request->jenis_mobil,
            'nomor_plat'     => $request->nomor_plat,
            'harga'          => $request->harga,
            'jenis_layanan'  => $request->jenis_layanan,
            'status'         => $request->status,
            'karyawan_id'    => $request->karyawan_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data antrian berhasil diperbarui');
    }

    // Hapus antrian
    public function destroy($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->delete();

        return redirect()->route('dashboard')->with('success', 'Antrian berhasil dihapus!');
    }
    public function search(Request $request)
{
    $keyword = $request->query('query', '');

    $antrians = Antrian::with('karyawan')
        ->where('nama_pelanggan', 'like', "%{$keyword}%")
        ->orderBy('nomor_antrian', 'asc')  // Urutkan berdasarkan nomor antrian
        ->get();

    return response()->json($antrians);
}

    // app/Http/Controllers/AntrianController.php

    public function pelangganIndex()
    {
        $antrians = \App\Models\Antrian::with('karyawan')
                     ->orderBy('created_at')
                     ->get();
    
        return view('pelanggan.index', compact('antrians'));
    }
}
