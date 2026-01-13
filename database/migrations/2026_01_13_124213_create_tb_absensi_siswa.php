<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_absensi_siswa', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_absensi');
            $table->string('status_absensi');
            $table->string('nidn');
            $table->string('nama_siswa');
            $table->string('id_kelas');
            $table->string('nama_kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_absensi_siswa');
    }
};
