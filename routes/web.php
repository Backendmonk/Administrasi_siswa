<?php

use App\Http\Controllers\ControllerSiswa;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\DataMuridConttroller;
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
});

Route::get('/home',function(){
        return redirect('/Admin/index');
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

        });





        Route::middleware(['userakses:Guru'])->group(function(){

                //controller route funcion
                Route::controller(DataGuruController::class)->group(function(){
                        Route::get('/Guru/index','index');                       
                });
        });


        
        Route::middleware(['userakses:Murid'])->group(function(){

                //controller route funcion
                Route::controller(DataMuridConttroller::class)->group(function(){
                        Route::get('/Murid/index','index');                       
                });
        });
        


});
