<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modelkelas;
use App\Models\ModelKelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerGuruAbsensi extends Controller
{

    
     public function AbsensiView(Request $reqAbsensi){
        //code lihat nilai
        $idguru = Auth::user()->id;
         $data = [

            'DataKelas'=>Modelkelas::where('id_wali','=',$idguru)->orderby('id')->get(),
        ];
         
       
         return view('Guru.AbsensiView',$data);
     

     }


        public function tambahAbsensi(Request $reqtambahabsensi){
            //code tambah absensi
    
              $id_kelas = $reqtambahabsensi->id_kelas;

                $reqdata = [
                    'id_kelas'=>ModelKelasSiswa::where('kode_kelas','=',$id_kelas)->get(),
                    'id_kelas2'=>Modelkelas::where('id','=',$id_kelas)->first(),

                ];

    
        
    
            


            return view('Guru.tambahAbsensiSiswa',$reqdata);
        
    
        }
    //
}
