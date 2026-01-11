<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modelkelas;
use App\Models\ModelKelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerGuruPenilaian extends Controller
{
    //
    public function penilaianView(){
        $idguru = Auth::user()->id;
         $reqdata = [

            'DataKelas'=>Modelkelas::where('id_wali','=',$idguru)->orderby('id')->get(),
        ];
        return view('Guru.penilaian',$reqdata);
    }

    public function tambahNilaiView(Request $reqtambahnilai){
        $id_kelas = $reqtambahnilai->id_kelas;

        $reqdata = [
            'id_kelas'=>ModelKelasSiswa::where('kode_kelas','=',$id_kelas)->get(),
        ];

        return view('Guru.tambahNilaiSiswa',$reqdata);
    }

     public function tambahNilaimapel(){
        //code tambah nilai mapel
     

     }

 
}
