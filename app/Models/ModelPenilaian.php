<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPenilaian extends Model
{
    use HasFactory;
    protected $fillable  = ['id_siswa','nama_siswa','id_kelas','nama_kelas','id_mapel','mata_pelajaran','tahun_ajaran','semester','nilai'];
    protected $table = 'tb_penilaian';
    protected $primaryKey = 'id';

    
}
