<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelabsensi extends Model
{
    use HasFactory;
    protected $table = 'tb_absensi_siswa';
    protected $fillable = [
        'tanggal_absensi',
        'status_absensi',
        'nidn',
        'nama_siswa',
        'id_kelas',
        'nama_kelas',
    ];
        public $incrementing = true;
        protected $primaryKey = 'id';

}
