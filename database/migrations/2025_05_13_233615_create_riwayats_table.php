<?php
// database/migrations/{timestamp}_create_riwayats_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatsTable extends Migration
{
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->string('id_antrian', 50);
            $table->string('nomor_antrian');
            $table->string('nama_pelanggan');
            $table->string('no_wa', 15);
            $table->string('nomor_plat')->nullable();
            $table->string('jenis_mobil');
            $table->decimal('harga', 10, 2);
            $table->enum('jenis_layanan', ['Cuci Full', 'Cuci Body + Interior', 'Cuci Body Saja'])->default('Cuci Full');
            $table->enum('status', ['Antrian', 'Dikerjakan', 'Selesai'])->default('selesai');
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id_karyawan')->on('karyawans')->onDelete('cascade'); // onDelete cascade jika karyawan dihapus
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayats');
    }
}
