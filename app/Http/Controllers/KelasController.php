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

        return view('Admin.datakelas',$reqdata);
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

    $cekketersediaanGuru = Modelkelas::where('id_wali',$idguru)
    ->where('StatusKelas','Aktif')->count();

    if ($cekketersediaanGuru > 0) {
        # code...
        return redirect('/adm/dataskelas')->with('error','Guru Sudah Menjadi Wali Kelas. Harap Cek Kembali Apakah Kelas Masih Digunakan ?');
    }else{
         try {
                $inputKelas = NEW Modelkelas();
    
              
                $inputKelas->nama_kelas=$idkelas;
                $inputKelas->id_wali = $idguru;
                $inputKelas->Nama_wali = $namaguru;
                $inputKelas->StatusKelas = 'Aktif';
    
    
                $inputKelas->save();
                return redirect('/adm/dataskelas')->with('message','Data Berhasil Ditambah');
    
    
            } catch (\Throwable $th) {
                //throw $th;
    
                return redirect('/adm/dataskelas')->with('error','Data Gagal Ditambah');
            }    

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
public function prosessiswakelas(Request $reqinputkelas) {
    $nidn = $reqinputkelas->nidn;
    $nama = $reqinputkelas->namasiswa;
    $idkelas = $reqinputkelas->idkelas;

    // 1. Cari apakah siswa sudah terdaftar sebelumnya
    $siswaExist = ModelKelasSiswa::where('NIDN', $nidn)->first();

    if ($siswaExist) {
        $kelasLama = Modelkelas::where('id', $siswaExist->kode_kelas)->first();

        // 2. Jika kelas lamanya AKTIF, blokir pendaftaran
        if ($kelasLama && $kelasLama->StatusKelas === "Aktif") {
            return redirect()->back()->with('error', 'Siswa masih terdaftar di kelas yang Aktif!');
        }
        
        // 3. Jika lolos (berarti kelas lama NonAktif), kita pakai data yang sudah ada untuk di-UPDATE
        $inputkelassiswa = $siswaExist; 
    } else {
        // 4. Jika benar-benar siswa baru, buat baris BARU
        $inputkelassiswa = new ModelKelasSiswa;
    }

    try {
        // Isi/Timpa data dengan yang baru
        $inputkelassiswa->kode_kelas = $idkelas;
        $inputkelassiswa->NIDN = $nidn;
        $inputkelassiswa->nama_siswa = $nama;
        $inputkelassiswa->save(); // Eloquent otomatis tahu ini UPDATE jika $siswaExist ditemukan, atau INSERT jika 'new'

        return redirect('/adm/tambahSiswaKelas/'.$idkelas)->with('message', 'Data Berhasil Diperbarui/Ditambah');

    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Gagal memproses data');
    }
}


        /**
         * Nonaktifkan kelas
         *
         * @param  \Illuminate\Http\Request  $req
         * @return \Illuminate\Http\Response
         */
        
    public function nonaktifkanKelas(Request $req){
            $idkelas = $req->idkelas;
            $status = "NonAktif";


            $updatekelas = Modelkelas::find($idkelas);
            $updatekelas->StatusKelas = $status;
            $updatekelas->save();
            return redirect()->route('kelas')->with('message','Nonaktif');


    }

        /**
         * Hapus kelas
         *
         * @param  \Illuminate\Http\Request  $req
         * @return \Illuminate\Http\Response
         */
    public function HapusKelas(Request $req){
        $idkelas = $req->idkelas;

        $kelas = Modelkelas::find($idkelas);
        $klsSiswa = ModelKelasSiswa::where('kode_kelas','=',$idkelas)->get();

        $kelas->delete();
        foreach ($klsSiswa as $item) {
                $item->delete();
            }
        
        return redirect()->route('kelas')->with('message','Hapus Berhasil');

    }

            
}
