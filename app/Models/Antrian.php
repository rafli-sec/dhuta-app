<?php

// app/Models/Antrian.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_antrian';
    public $incrementing = false; // karena id_antrian bukan integer auto-increment
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_antrian', 'nomor_antrian', 'nama_pelanggan', 'no_wa', 'jenis_mobil',
        'harga', 'jenis_layanan' ,'status', 'karyawan_id', 'nomor_plat'
    ];
    
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id_karyawan');
    }

    
}






