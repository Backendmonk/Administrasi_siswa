<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_Mapel extends Model
{
    use HasFactory;

    protected $fillable  = ['*'];
    protected $table = 'tb_pelajaran';
    protected $primaryKey = 'id';
    

}
