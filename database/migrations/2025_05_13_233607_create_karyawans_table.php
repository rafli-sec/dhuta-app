<?php
// database/migrations/{timestamp}_create_karyawans_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->string('nama');
            $table->string('no_wa', 15);
            $table->text('alamat');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
    
}
