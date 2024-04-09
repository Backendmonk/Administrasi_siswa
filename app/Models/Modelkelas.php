<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelkelas extends Model
{
    use HasFactory;


    protected $fillable  = ['*'];

    protected $table = 'db_kelas';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $incrementing = true;
}
