<?php

namespace App\Exports;

use App\Models\Riwayat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RiwayatExport implements FromCollection, WithHeadings
{
    public function collection()
{
    return Riwayat::with('karyawan')->get()->map(function($item) {
        return [
            'id_antrian'     => $item->id_antrian,
            'nomor_antrian'  => $item->nomor_antrian,
            'nama_pelanggan' => $item->nama_pelanggan,
            'jenis_mobil'    => $item->jenis_mobil,
            'nomor_plat'     => $item->nomor_plat,
            'no_wa'          => "'" . $item->no_wa, // paksa jadi teks
            'karyawan'       => $item->karyawan->nama ?? '-',
            'harga'          => $item->harga,
            'status'         => $item->status,
            'created_at'     => $item->created_at->format('d/m/Y H:i'),
            'updated_at'     => $item->updated_at->format('d/m/Y H:i'),
        ];
    });
}


    public function headings(): array
    {
        return [
            'id_antrian',
            'Nomor Antrian',
            'Nama Pelanggan',
            'Jenis Mobil',
            'Nomor Plat',
            'No WA',
            'Karyawan',
            'Harga',
            'Status',
            'Dibuat Pada',
            'Diupdate Pada',
        ];
    }
}
