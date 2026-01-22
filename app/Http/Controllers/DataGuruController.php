<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataGuruController extends Controller
{
  public function index() {
    // Statistik sederhana untuk Dashboard
    $data = [
        'total_siswa' => DB::table('tb_absensi_siswa')->distinct('nidn')->count(),
        'total_kelas' => DB::table('db_kelas')->count(),
        'absen_hari_ini' => DB::table('tb_absensi_siswa')
                            ->whereDate('tanggal_absensi', Carbon::today())
                            ->count(),
        'recent_absensi' => DB::table('tb_absensi_siswa')
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get()
    ];

    return view('Guru.index', $data);
}
}
