<?php

namespace App\Http\Controllers;

use App\Models\ModelUserBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataAdminController extends Controller
{
    
  public function index() {
        $totalSiswa = ModelUserbaru::count();
        $lakiLaki = ModelUserbaru::where('jeniskelamin', 'Laki-Laki')->count();
        $perempuan = ModelUserbaru::where('jeniskelamin', 'Perempuan')->count();
        $siswaTerbaru = ModelUserbaru::latest()->take(5)->get();

        // Data untuk Grafik: Jumlah siswa per asal sekolah
        $siswaPerSekolah = ModelUserbaru::select('asal_sekolah', DB::raw('count(*) as total'))
                                        ->groupBy('asal_sekolah')
                                        ->pluck('total', 'asal_sekolah')
                                        ->toArray();

        $labelsSekolah = array_keys($siswaPerSekolah);
        $dataSekolah = array_values($siswaPerSekolah);

        // Data untuk Grafik: Jumlah siswa per Jenis Kelamin (sudah ada)
        $labelsJenisKelamin = ['Laki-Laki', 'Perempuan'];
        $dataJenisKelamin = [$lakiLaki, $perempuan];

        return view('admin.index', compact(
            'totalSiswa',
            'lakiLaki',
            'perempuan',
            'siswaTerbaru',
            'labelsSekolah',
            'dataSekolah',
            'labelsJenisKelamin',
            'dataJenisKelamin'
        ));
    }
}
