<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKelasSiswa extends Model
{
    use HasFactory;

    protected $fillable  = ['*'];

    protected $table = 'db_kelassiswa';

    protected $primaryKey = 'id';

    public $timestamps = True;

    public $incrementing = True;

}
