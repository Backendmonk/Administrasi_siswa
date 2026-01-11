<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Model_Mapel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ControllerMapel extends Controller
{
    //
    public function index(){
        $reqdata = [
            'datamapel'=>Model_Mapel::orderby('id')->get(),
        ];

        return view('Admin.DataMapel',$reqdata);
    }

    public function MapelAddView(){
        return view('Admin.TambahMapel');
    }
    public function MapelAddProses(Request $reqinputmapel){
        $inputmapel = NEW Model_Mapel();

        $inputmapel->id = $reqinputmapel->id;
        $inputmapel->nama_pelajaran = $reqinputmapel->nama_mapel;
        // $inputmapel->nama_guru = $reqinputmapel->nama_guru;

        $inputmapel->save();

        return redirect('/adm/Mapel')->with('success','Data Mata Pelajaran Berhasil Ditambahkan');
    }

    public function toolsAdminMapel(Request $reqmapeltools){
       $tools = [

            'edit'=>$reqmapeltools->edit,
            'delete'=>$reqmapeltools->delete,
        ];
        $id = $reqmapeltools->id;
        if ($tools['edit']) {
            # code...
            return redirect('/adm/editMapel/'.$tools['edit']);

    }
        if ($tools['delete']) {
            # code...
            $deletemapel = Model_Mapel::find($id);
            $deletemapel->delete();

            return redirect('/adm/Mapel')->with('success','Data Mata Pelajaran Berhasil Dihapus');
        }
    }

    
}
