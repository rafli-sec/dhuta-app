<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_riwayat'; // Sesuaikan dengan pk riwayat

    protected $fillable = [
        'id_antrian',
        'nomor_antrian',
        'nama_pelanggan',
        'no_wa',
        'jenis_mobil',
        'nomor_plat',
        'harga',
        'jenis_layanan',
        'status',
        'karyawan_id',
        'created_at',
        'updated_at',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id_karyawan');
    }
}
