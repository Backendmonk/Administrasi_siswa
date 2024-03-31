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

    public function logout(){

        Auth::logout();
        return redirect('');
    }

    
}
