<?php

namespace App\Http\Controllers;

use App\Models\Modelkelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    //

    public function index(){
        $reqdata = [

            'DataKelas'=>Modelkelas::all(),
        ];

        return view('Admin.datasiswa',$reqdata);
    }

    public function tambahdatakelas(){

        return view('Admin.TambahKelas');
    }

    public function addkelasproses(request $reqinputkelas){

        $nomorkelas = $reqinputkelas->nomorkelas; 
        $kodekelas = $reqinputkelas->kodekelas;

        $idkelas = $nomorkelas.$kodekelas;

        try {
            $inputKelas = NEW Modelkelas;

            $inputKelas->id=$idkelas;
            $inputKelas->nama_kelas=$idkelas;


            $inputKelas->save();
            return redirect('/adm/datasiswa')->with('message','Data Berhasil Ditambah');


        } catch (\Throwable $th) {
            //throw $th;

            return redirect('/adm/datasiswa')->with('error','Data Gagal Ditambah');
        }
    }
}
