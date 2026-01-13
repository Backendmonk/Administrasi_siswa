<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Model_Mapel;
use App\Models\Modelkelas;
use App\Models\ModelKelasSiswa;
use App\Models\ModelPenilaian;
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

       

        
        

        return view('Guru.PilihMapelNilai',$data);
     

     }


     public function forminputnilai(Request $reqinputnilai){
        //code form input nilai

         $data = [
            'nidn'=>$reqinputnilai->id,
            'namasiswa'=>$reqinputnilai->namasiswa,
            'id_kelas'=>$reqinputnilai->id_kelas,
            'nama_kelas'=>$reqinputnilai->nama_kelas,
            'mapel'=>$reqinputnilai->mapel,
            'id_mapel'=>$reqinputnilai->id_mapel,
        ];

  
        

        return view('Guru.formInputNilai',$data);
     

     }

     public function prosesinputnilai( Request $reqdatanilai){


     $data = [
           'nidn' => $reqdatanilai->nidn,
            'namasiswa' => $reqdatanilai->nama_siswa,
            'id_kelas' => $reqdatanilai->id_kelas,
            'nama_kelas' => $reqdatanilai->nama_kelas,
            'mapel' => $reqdatanilai->mapel,
            'id_mapel' => $reqdatanilai->id_mapel,
            'tahunajaran' => $reqdatanilai->tahun_ajaran,
            'semester' => $reqdatanilai->semester,
            'nilai' => $reqdatanilai->nilai,

     ];

     //save ke Model penilaian 
        $inputtopenialaian  = new ModelPenilaian();

        $inputtopenialaian->fill([

            'id_siswa' => $data['nidn'],
            'nama_siswa' => $data['namasiswa'],
            'id_kelas' => $data['id_kelas'],
            'nama_kelas' => $data['nama_kelas'],
            'mata_pelajaran' => $data['mapel'],
            'id_mapel' => $data['id_mapel'],
            'tahun_ajaran' => $data['tahunajaran'],
            'semester' => $data['semester'],
            'nilai' => $data['nilai'],

        ])->save();

        

         return redirect('/Guru/penilaianView')->with('success','Nilai Berhasil di Tambahkan');
           
     }



     public function lihatNilai(Request $reqlihatnilai){
        //code lihat nilai

         $data = [
            'nidn'=>$reqlihatnilai->nidn,
            'namasiswa'=>$reqlihatnilai->namasiswa,
            'id_kelas'=>$reqlihatnilai->id_kelas,
            'nama_kelas'=>$reqlihatnilai->nama_kelas,
            'Penilaian'=>ModelPenilaian::where('id_siswa','=',$reqlihatnilai->nidn)
                                        ->where('id_kelas','=',$reqlihatnilai->id_kelas)->get(),
        ];

  
        
       
         return view('Guru.lihatNilaiSiswa',$data);
     

     }




     
    

 
}
