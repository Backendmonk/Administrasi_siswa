<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Model_Mapel;
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
            'id_kelas2'=>Modelkelas::where('id','=',$id_kelas)->first(),

        ];

        return view('Guru.tambahNilaiSiswa',$reqdata);
    }

     public function tambahNilaimapel(Request $reqinput){
        //code tambah nilai mapel

         $data = [
            'mapel'=>Model_Mapel::all(),
            'nidn'=>$reqinput->nidn,
            'namasiswa'=>$reqinput->namasiswa,
            'id_kelas'=>$reqinput->id_kelas,
            'nama_kelas'=>$reqinput->nama_kelas,
        ];

        dd($data);

        
        

       // return view('Guru.PilihMapelNilai',$data);
     

     }

     
   

 
}
