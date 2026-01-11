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
        Schema::create('tb_penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('id_siswa');
            $table->string('nama_siswa');
            $table->string('id_kelas');
            $table->string('nama_kelas');
            $table->string('id_mapel');
            $table->string('mata_pelajaran');
            $table->string('tahun_ajaran');
            $table->string('semester');
            $table->string('nilai');

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
        Schema::dropIfExists('tb_penilaian');
    }
};
