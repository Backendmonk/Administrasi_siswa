<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sesicontroller extends Controller
{
    public function index(){


        return view('login');
    }


    public function login (request $reqinput){

        $reqinput->validate([

            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required' => 'Email Tidak Boleh Kosong',
            'password.required'=>'Password Tidak Boleh Kosong'
        ]);

        $inputlog = [
            'email'=>$reqinput->email,
            'password'=>$reqinput->password
        ];


        if (Auth::attempt($inputlog)) {

            if (Auth::user()->role=='Admin') {
                return redirect('/Admin/index');
            }elseif (Auth::user()->role=='Guru') {
                return redirect('/Guru/index');
            }elseif (Auth::user()->role=='Murid') {
                return redirect('/Murid/index');
            }
            else{

                return redirect('')->withErrors('Username dan Password Salah')->withInput();
            }
        }


    }


    public function registerAkunAdd (request $reqinput){

        $reqinput->validate([

            'nama'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed|min:6'
        ],[
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.email' => 'Format Email Salah',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.required'=>'Password Tidak Boleh Kosong',
            'password.confirmed'=>'Konfirmasi Password Tidak Sesuai',
            'password.min'=>'Password Minimal 6 Karakter'
        ]);

        \App\Models\User::create([

            'name'=>$reqinput->nama,
            'email'=>$reqinput->email,
            'password'=>bcrypt($reqinput->password),
            'role'=>'Admin',
            'status_akun'=>'Aktif'
        ]);

        return redirect('/')->with('success','Akun Berhasil Didaftarkan, Silahkan Login');
    }

    public function logout(){

        Auth::logout();
        return redirect('');
    }

    
}
