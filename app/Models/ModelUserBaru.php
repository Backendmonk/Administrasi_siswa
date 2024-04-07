<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUserBaru extends Model
{
    use HasFactory;

    protected $fillable  = ['*'];

    protected $table = 'db_siswa_baru';

    protected $primaryKey = 'NIDN';

    public $timestamps = false;

    public $incrementing = false;
}
