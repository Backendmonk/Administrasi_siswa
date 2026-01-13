<?php

namespace App\Http\Controllers;

use App\Models\Model_Mapel;
use App\Models\User;
use Illuminate\Http\Request;

class ControllerGuru extends Controller
{
    //

    public function index(){
        
        $getdata_guru = [

            'dataGuru'=>User::where('role','Guru')->get()
        ];
        return view('Admin.DataGuru',$getdata_guru);
    }

    public function tambahAkunGuruView(){

        return view('Admin.TambahAkunGuru');
    }

    public function inputAkunGuru (request $reqinput){

        $email = $reqinput->email;
        $password = $reqinput->password;
        $nama_guru = $reqinput->nama_guru;
        $id = $reqinput->id;

        $cekketersediaanemail = User::where('email',$email)->first();

        if ($cekketersediaanemail) {
            return redirect('/adm/Guru_account')->withErrors('Email Sudah Terdaftar')->withInput();
        }
        else{

            $inputtbUser = new User();
            $inputtbUser->fill([
                'id'=>$id,
                'name'=>$nama_guru,
                'email'=>$email,
                'password'=>bcrypt($password),
                'role'=>'Guru',
              
            ])->save();

            return redirect('/adm/dataguru')->with('success','Akun Berhasil Ditambahkan');
        }
       
    }


    public function manageGuruAccount (request $reqinput){

        
        $tools = [

            'edit'=>$reqinput->edit,
            'delete'=>$reqinput->delete,
        ];
        $id = $reqinput->id;

        if ($tools['edit'] == 'edit') {
            //kode edit disini
            $cekdataguru = [

                'dataGuru'=>User::where('id','=',$id)->first(),
            ];
            return view('Admin.editGuru',$cekdataguru);
        }
        elseif ($tools['delete'] == 'delete') {
            //hapus akun 
            $hapusakun = User::find($id);
            $hapusakun->delete();   
            return redirect('/adm/dataguru')->with('success','Akun Berhasil Dihapus');
          
        }

    }


    public function manageGuruAccountEdited (request $reqinputedit){

        $id = $reqinputedit->id;
        $nama_guru = $reqinputedit->nama_guru;
        $email = $reqinputedit->email;
        $password = $reqinputedit->password;

        $cekdataakun = User::find($id);

        $cekdataakun->fill([
            'id'=>$id,
            'name'=>$nama_guru,
            'email'=>$email,
            'password'=>bcrypt($password),
        ])->save();

        return redirect('/adm/dataguru')->with('success','Akun Berhasil Diupdate');
    }



    
}
