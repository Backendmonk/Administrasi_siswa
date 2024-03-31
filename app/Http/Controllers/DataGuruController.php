<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataGuruController extends Controller
{
    public function index(){
        return view('Guru.index');
    }
}
