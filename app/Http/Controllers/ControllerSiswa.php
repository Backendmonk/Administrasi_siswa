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

    public function editsiswa($NIDN){

        $datasiswa = ModelUserBaru::find($NIDN);

        $siswaarr = [
            'nidn'=>$NIDN,
            'nama'=>$datasiswa->nama,
            'email'=>$datasiswa->email,
            'tgl'=>$datasiswa->tg_tl,
            'jk'=>$datasiswa->jeniskelamin,
            'asal_sekolah'=>$datasiswa->asal_sekolah,
            'alamat'=>$datasiswa->alamat,
            'seleksi'=>$datasiswa->seleksi,
            'nama_orangtua'=>$datasiswa->nama_orangtua,
            'pekerjaanortu'=>$datasiswa->pekerjaan_orangtua,
            

        ];

        return View('Admin.editsiswa',$siswaarr);

       
    }


    public function updatedatasiswa(request $reqinputformupdate){
        $nidn = $reqinputformupdate->nidn;
        $nama= $reqinputformupdate->nama;
        $email= $reqinputformupdate->email;
        $tg_tl= $reqinputformupdate->tgllahir;
        $jeniskelamin= $reqinputformupdate->jk;
        $asal_sekolah= $reqinputformupdate->asalsklh;
        $alamat= $reqinputformupdate->alamat;
        $seleksi= $reqinputformupdate->seleksi;
        $nama_orangtua= $reqinputformupdate->namaOrtu;
        $pekerjaan_orangtua= $reqinputformupdate->pekerjaanortu;


        
        try {
            //code...

            $updatedata = ModelUserBaru::find($nidn);
            
            $updatedata -> nama = $nama;
            $updatedata -> email = $email;
            $updatedata -> tg_tl = $tg_tl;
            $updatedata -> jeniskelamin = $jeniskelamin;
            $updatedata -> asal_sekolah = $asal_sekolah;
            $updatedata -> alamat = $alamat;
            $updatedata -> seleksi = $seleksi;
            $updatedata -> nama_orangtua = $nama_orangtua;
            $updatedata -> pekerjaan_orangtua = $pekerjaan_orangtua;

            $updateuser = user::find($nidn);

            $updateuser ->name = $nama;
            $updateuser -> email = $email;

            $updatedata->save();
            $updateuser->save();

            return redirect('/adm/siswabaru')->with('message','Data Berhasil Diubah');

         
        } catch (\Throwable $th) {
            //throw $th;
           return redirect('/adm/siswabaru')->with('error','Data Gagal Diubah');
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
