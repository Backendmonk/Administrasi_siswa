<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modelabsensi;
use App\Models\Modelkelas;
use App\Models\ModelKelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


        public function tambahabsensiview(Request $reqtambahabsensiview){
            //code tambah absensi view
    
              $data = [
            'nidn'=>$reqtambahabsensiview->nidn,
            'namasiswa'=>$reqtambahabsensiview->namasiswa,
            'id_kelas'=>$reqtambahabsensiview->id_kelas,
            'nama_kelas'=>$reqtambahabsensiview->nama_kelas,
           
        ];


         
       
          return view('Guru.formTambahAbsensi',$data);
     

        }


        public function prosesinputabsen(Request $reqprosesinputabsen){
            //code proses input absensi
                $data=[

                    'tanggal_absensi'=>$reqprosesinputabsen->tanggal,
                    'status_absensi'=>$reqprosesinputabsen->status_absensi,
                    'nidn'=>$reqprosesinputabsen->nidn,
                    'nama_siswa'=>$reqprosesinputabsen->nama_siswa,
                    'id_kelas'=>$reqprosesinputabsen->id_kelas,
                    'nama_kelas'=>$reqprosesinputabsen->nama_kelas,

                ];


                // validasi tanggal apakah sudah pernah absen
                $cektanggal = Modelabsensi::where('tanggal_absensi','=',$data['tanggal_absensi'])
                ->where('nama_siswa','=',$data['nama_siswa'])->count();
                if($cektanggal > 0){
                    return redirect('/Guru/AbsensiView')->with('error','Siswa sudah absen pada tanggal tersebut');
                }else{

                    $inputtb = new Modelabsensi();
                    $inputtb->fill([

                        'tanggal_absensi'=>$data['tanggal_absensi'],
                        'status_absensi'=>$data['status_absensi'],
                        'nidn'=>$data['nidn'],
                        'nama_siswa'=>$data['nama_siswa'],
                        'id_kelas'=>$data['id_kelas'],
                        'nama_kelas'=>$data['nama_kelas'],
                    ]);
                    $inputtb->save();
                    return redirect('/Guru/AbsensiView')->with('success','Absensi berhasil ditambahkan');
                }
                // simpan data ke model absensi
              

             
        }

       public function lihatrekapAbsensi(Request $request) {
    // Ambil data dari tabel berdasarkan NIDN/NISN dan ID Kelas
    $rekapAbsensi = DB::table('tb_absensi_siswa')
        ->where('nidn', $request->nidn)
        ->where('id_kelas', $request->id_kelas)
        ->orderBy('tanggal_absensi', 'desc')
        ->get();

    // Hitung ringkasan status
    $summary = [
        'hadir' => $rekapAbsensi->where('status_absensi', 'hadir')->count(),
        'izin'  => $rekapAbsensi->where('status_absensi', 'izin')->count(),
        'sakit' => $rekapAbsensi->where('status_absensi', 'sakit')->count(),
        'alpha' => $rekapAbsensi->where('status_absensi', 'alpha')->count(),
    ];

    $data = [
        'nidn'         => $request->nidn,
        'namasiswa'    => $request->namasiswa,
        'id_kelas'     => $request->id_kelas,
        'nama_kelas'   => $request->nama_kelas,
        'rekapAbsensi' => $rekapAbsensi,
        'summary'      => $summary
    ];

    return view('Guru.rekapAbsensiSiswa', $data);
}
    //
}
