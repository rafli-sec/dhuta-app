<?php
// database/migrations/{timestamp}_create_antrians_table.php
// database/migrations/{timestamp}_create_antrians_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntriansTable extends Migration
{
    public function up()
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id('id_antrian');
            $table->string('nama_pelanggan');
            $table->string('no_wa', 15);
            $table->string('jenis_mobil');
            $table->string('nomor_plat')->nullable();  // Tambahkan nomor plat
            $table->decimal('harga', 10, 2);
            $table->enum('jenis_layanan', ['Cuci Full', 'Cuci Body + Interior', 'Cuci Body Saja'])->default('Cuci Full');
            $table->enum('status', ['Antrian', 'Dikerjakan', 'Selesai'])->default('antrian');
            
            // Kolom baru untuk nomor plat
            
            // Relasi ke karyawan
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id_karyawan')->on('karyawans');
            
            $table->timestamps();

               
        });
    }

    public function down()
    {
        Schema::dropIfExists('antrians');
    }
}

