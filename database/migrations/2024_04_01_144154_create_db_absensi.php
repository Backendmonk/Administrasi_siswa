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
        Schema::create('db_absensi', function (Blueprint $table) {
            $table->id();
            $table->string('NIDN');
            $table->string('nama_siswa');
            $table->string('id_kelas');
            $table->string('nama_kelas');
            $table->date('tanggal_absensi');
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
        Schema::dropIfExists('db_absensi');
    }
};
