<?php

namespace App\Http\Controllers;

use App\Models\Modelkelas;
use App\Models\ModelKelasSiswa;
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
                'namaguru'=>$Getkelas->Nama_wali,
                
                  
        ];   
        
          
          return View('Admin.TambahSiswaKelas',$arrayDataSiswaKelas);
    }


    public function editkelasview($idkelas){

            $dataEdit = [

                'Dataguru' =>User::Where('role','=','Guru')->get(),
                'idkelas'=> $idkelas,
            ];

            return view('Admin.editkelas',$dataEdit);
    }


    public function datasiswakelasview($id){
        $kodekelasget = Modelkelas::find($id);
        $kelasgetarray = [

            'datasiswa' => ModelKelasSiswa::where('kode_kelas','=',$id)->get(),
            'Kodekelas'=> $kodekelasget->id,
        ];

        return view('Admin.DatasiswaKelas',$kelasgetarray);
    }

    public function proseseditkelas(Request $reqinputeditKelas){

        $idguru = $reqinputeditKelas->walikelas;
        $idkelas = $reqinputeditKelas->idkelas;

        $dataguru = user::find($idguru);

        $namaguruGet = [
            'nama'=>$dataguru->name
        ];

        $namaguru = $namaguruGet['nama'];
        if ($idguru == "null") {
            return redirect()->back()->with('error','Pilih Data Wali');
        }else{
            try {

                $updatedata = Modelkelas::find($idkelas);
                $updatedata->id_wali = $idguru;
                $updatedata->nama_wali = $namaguru;

                $updatedata->save();
                return redirect('/adm/tambahSiswaKelas/'.$idkelas)->with('message','Data Berhasil Terupdate');

                //code...
            } catch (\Throwable $th) {
                return redirect()->back()->with('error','Gagal Update');
            }
        }
    }

    public function prosessiswakelas(request $reqinputkelas){

        $nidn = $reqinputkelas->nidn;
        $nama = $reqinputkelas->namasiswa;
        $idkelas = $reqinputkelas->idkelas;
        
        $selectsiswa = ModelKelasSiswa::Where('NIDN','=',$nidn)->get()->count();

        if ($selectsiswa < 1) {
            # code...
            try {
                $inputkelassiswa = New ModelKelasSiswa;

                $inputkelassiswa->kode_kelas = $idkelas;
                $inputkelassiswa->NIDN = $nidn;
                $inputkelassiswa->nama_siswa = $nama;

                $inputkelassiswa->save();
                return redirect('/adm/tambahSiswaKelas/'.$idkelas)->with('message','Data Berhasil Ditambah');


        
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Gagal Ditambah');
        }
        }else{
            return redirect()->back()->with('error','Data Siswa Sudah Memiliki Kelas');
        }
       
       

       
    }
}
