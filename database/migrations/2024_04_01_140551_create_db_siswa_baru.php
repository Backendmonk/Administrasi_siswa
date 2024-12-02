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
        Schema::create('db_siswa_baru', function (Blueprint $table) {
            $table->string('NIDN');
            $table->string('email');
            $table->string('nama');
            $table->date('tg_tl');
            $table->enum('jeniskelamin',['Laki-Laki','Perempuan'])->default('Laki-Laki');
            $table->string('asal_sekolah');
            $table->string('alamat');
            $table->string('seleksi');
            $table->string('nama_orangtua');
            $table->string('pekerjaan_orangtua');
            
          
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
        Schema::dropIfExists('db_siswa_baru');
    }
};
