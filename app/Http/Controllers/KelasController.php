<?php

namespace App\Http\Controllers;

use App\Models\Modelkelas;
use App\Models\ModelUserBaru;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    //

    public function index(){
        $reqdata = [

            'DataKelas'=>Modelkelas::orderby('id')->get(),
        ];

        return view('Admin.datasiswa',$reqdata);
    }

    public function tambahdatakelas(){
        
        $reqdataguru = [
            'dataguru'=>User::all(),
        ];
        return view('Admin.TambahKelas',$reqdataguru);
    }

    public function addkelasproses(request $reqinputkelas){

        $nomorkelas = $reqinputkelas->nomorkelas; 
        $kodekelas = $reqinputkelas->kodekelas;
        $idguru = $reqinputkelas->walikelas;
        //select
        $selectguru = User::find($idguru);
        //fetch array
        $dataguru = [
            'name'=>$selectguru->name,
        ];
        
       $namaguru = $dataguru['name'];

        $idkelas = $nomorkelas.$kodekelas;
        
    //   //  $countid = User::where('id','LIKE',"%{$idguru}%")->count()->get(); (incase digunakan)

    
            try {
                $inputKelas = NEW Modelkelas;
    
                $inputKelas->id=$idkelas;
                $inputKelas->nama_kelas=$idkelas;
                $inputKelas->id_wali = $idguru;
                $inputKelas->Nama_wali = $namaguru;
    
    
                $inputKelas->save();
                return redirect('/adm/datasiswa')->with('message','Data Berhasil Ditambah');
    
    
            } catch (\Throwable $th) {
                //throw $th;
    
                return redirect('/adm/datasiswa')->with('error','Data Gagal Ditambah');
            }     
       
    }


    public function tambahsiswakeKelas($id){
        // buat variable untuk menampung semua field dan data yang ada pada table kelas
        $Getkelas = Modelkelas::find($id);
        

        //buat array untuk menampung banyak variable yang akan di pass ke view
        $arrayDataSiswaKelas = [
                //variable untuk memanggil semua field table siswa
                'datasiswa' => ModelUserBaru::all(),
                //memanggil id kelas pada variable Getkelas (yang menampung Field table kelas)
                'idkelas'=> $Getkelas->id,
        ];

        return View('Admin.TambahSiswaKelas',$arrayDataSiswaKelas);
    }


    public function prosessiswakelas(request $reqinputkelas){

        $isi = $reqinputkelas->siswa;

        var_dump($isi);
    }
}
