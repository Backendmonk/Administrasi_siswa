<?php

namespace App\Http\Controllers;

use App\Models\ModelUserBaru;
use App\Models\User;
use Illuminate\Http\Request;

class ControllerSiswa extends Controller
{
    public function index(){
            
        $datasiswa = [
            
           'SiswaData'=>ModelUserBaru::all()
            
        ];
            
            return view('Admin.siswabaru',$datasiswa);
    }


    public function dirrectsiswaBaru(){

        return view('Admin.siswaBaruform');

        
    }

    public function sumitdatasiswa(request $reqfromsiswa){

       
       
        $NIDN = $reqfromsiswa->nidn;
        $nama = $reqfromsiswa->nama;
        $email = $reqfromsiswa->email;
        $tgllahir = $reqfromsiswa->tgllahir;
        $jk = $reqfromsiswa->jk;
        $asalSK = $reqfromsiswa->asalsklh;
        $alamat = $reqfromsiswa->alamat;
        $seleksi = $reqfromsiswa->seleksi;
        $namaOrtu =$reqfromsiswa->namaOrtu;
        $pekerjaanortu = $reqfromsiswa->pekerjaanortu;
        $password = $NIDN;

            try {
                //code...

                $inputTbSiswa = NEW ModelUserBaru;

                $inputTbSiswa->NIDN=$NIDN;
                $inputTbSiswa->email=$email;
                $inputTbSiswa->nama=$nama;
                $inputTbSiswa->tg_tl=$tgllahir;
                $inputTbSiswa->jeniskelamin=$jk;
                $inputTbSiswa->asal_sekolah=$asalSK;
                $inputTbSiswa->alamat=$alamat;
                $inputTbSiswa->seleksi=$seleksi;
                $inputTbSiswa->nama_orangtua=$namaOrtu;
                $inputTbSiswa->pekerjaan_orangtua=$pekerjaanortu;

                
                $inputuserbaru = new User;

                $inputuserbaru -> id = $NIDN;
                $inputuserbaru->name = $nama;
                $inputuserbaru->email = $email;
                $inputuserbaru->password = bcrypt($password);
                $inputuserbaru->role = 'Murid';


                $inputTbSiswa->save();
                $inputuserbaru->save();

                return redirect('/adm/siswabaru')->with('message','Data Berhasil Ditambah');
      
            } catch (\Throwable $th) {
                return redirect('/adm/siswabaru')->with('error','Data Gagal Ditambah');
            }
                
    }



    public function hapusiswabaru($NIDN){

        

        try {
            ModelUserBaru::find($NIDN)->delete();
            return redirect('/adm/siswabaru')->with('delete','Data Berhasil Dihapus');
      
        } catch (\Throwable $th) {
            return redirect('/adm/siswabaru')->with('error','Data Gagal Dihapus');
        }
    }
}
