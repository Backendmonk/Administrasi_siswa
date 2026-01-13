<?php

use App\Http\Controllers\ControllerGuru;
use App\Http\Controllers\ControllerGuruPenilaian;
use App\Http\Controllers\ControllerMapel;
use App\Http\Controllers\ControllerSiswa;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\DataMuridConttroller;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\Sesicontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route :: middleware(['guest'])->group(function(){

        Route::get('/',[Sesicontroller::class,'index'])->name('login');
        Route::post('/',[Sesicontroller::class,'login']);

        route::post('/registerAkunAdd',[Sesicontroller::class,'registerAkunAdd']);
});

Route::get('/home',function(){
        return redirect('/Admin/index');
});

Route::get('/registerAkun',function(){
        return view('/registerAkun');
});



//akun tidak aktif

Route::get('/AkunTidakAktif',function(){
        return view('/AkunTidakAktif');
});


route::get('/testrouteTestroute',function(){
        return redirect('/');
});

Route::get('/logout',[Sesicontroller::class,'logout']);


Route::middleware(['auth'])->group(function(){

        Route::middleware(['userakses:Admin'])->group(function(){
        
                //controller route
                 Route::controller(DataAdminController::class)->group(function(){
                        Route::Get('/Admin/index','index');
                        
                });

                Route::controller(ControllerSiswa::class)->group(function(){

                        Route::get('/adm/siswabaru','index');
                        route::get('/adm/muridbaru_view','dirrectsiswaBaru');
                        route::post('/adm/inputdata','sumitdatasiswa');
                        route::get('/adm/delete_siswa/{NIDN}','hapusiswabaru');
                        route::get('/adm/editSiswa/{NIDN}','editsiswa');
                        route::put('/adm/updatesiswa','updatedatasiswa');

                });


                Route::controller(KelasController::class)->group(function(){
                        route::get('/adm/dataskelas','index')->name('kelas');
                        route::get('/adm/kelassAdd','tambahdatakelas');
                        route::Post('/adm/proseskelas','addkelasproses');
                        route::get('/adm/tambahSiswaKelas/{id}','tambahsiswakeKelas');
                        route::post('/adm/prosessiswakelas','prosessiswakelas');
                        route::get('/adm/editkelas/{idkelas}','editkelasview');
                        route::post('/adm/proseseditkelas','proseseditkelas');
                        route::get('/adm/datasiswakelas/{id}','datasiswakelasview');
                        route::post('/adm/nonaktifkanKelas','nonaktifkanKelas');
                        route::post('/adm/hapusKelas','HapusKelas');
                        
                });

                route::controller(ControllerMapel::class)->group(function(){
                        route::get('/adm/Mapel','index')->name('mapel');
                        route::get('/adm/MapelAddView','MapelAddView');
                        route::post('/adm/MapelAddProses','MapelAddProses');
                        route::get('/toolsAdmin/Mapel','toolsAdminMapel');
                });

                Route::controller(ControllerGuru::class)->group(function(){


                        route::get('/adm/dataguru','index')->name('dhguru');
                        route::get('/adm/Guru_account','tambahAkunGuruView');
                        route::post('/adm/inputdataGuru','inputAkunGuru');
                        route::get('/toolsAdmin/Guru','manageGuruAccount');
                        route::post('/adm/inputdataGuruEdited','manageGuruAccountEdited');

                        
                });

        });



        /////////////////////////////////////////////////////////////

        Route::middleware(['userakses:Guru'])->group(function(){

                //controller route funcion
                Route::controller(DataGuruController::class)->group(function(){
                        Route::get('/Guru/index','index');                       
                });


                route::controller(ControllerGuruPenilaian::class)->group(function(){
                        route::get('/Guru/penilaianView','penilaianView');
                        route::get('/Guru/tambahNilai','tambahNilaiView');
                        route::post('/Guru/tambahNilaimapel','tambahNilaimapel');
                        route::post('/Guru/penilaianProses','penilaianProses');
                });
        });


        ////////////////////////////////////////////////////////////////
        Route::middleware(['userakses:Murid'])->group(function(){

                //controller route funcion
                Route::controller(DataMuridConttroller::class)->group(function(){
                        Route::get('/Murid/index','index');                       
                });
        });
        


});
