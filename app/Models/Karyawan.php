<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;


    protected $table = 'karyawans';  // Ini hanya diperlukan jika nama tabel bukan 'karyawans'


    protected $primaryKey = 'id_karyawan'; // Menentukan kolom primary key

    // Menentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama',
        'no_wa',
        'alamat',
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id_karyawan');
    }

}


