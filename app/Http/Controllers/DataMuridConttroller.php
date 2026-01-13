<?php

namespace App\Http\Controllers;

use App\Models\Modelkelas;
use App\Models\ModelKelasSiswa;
use App\Models\ModelUserBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataMuridConttroller extends Controller
{
    //

    public function index(){

        return view('Murid.index');
    }

 public function AbsensiView(Request $request)
{
    $email = Auth::user()->email;
    $userSiswa = ModelUserBaru::where('email', $email)->first();

    if (!$userSiswa) {
        return redirect()->back()->with('error', 'Data profil siswa tidak ditemukan.');
    }

    $kelasSiswa = DB::table('db_kelas')
        ->where('id', $userSiswa->id_kelas)
        ->first();

    // --- LOGIKA FILTER TANGGAL ---
    $query = DB::table('tb_absensi_siswa')->where('nidn', $userSiswa->NIDN);

    // Filter berdasarkan Bulan & Tahun
    if ($request->filled('bulan')) {
        $query->whereMonth('tanggal_absensi', $request->bulan);
    }
    if ($request->filled('tahun')) {
        $query->whereYear('tanggal_absensi', $request->tahun);
    }

    // Filter berdasarkan Range Tanggal (Opsional jika ingin lebih spesifik)
    if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
        $query->whereBetween('tanggal_absensi', [$request->tgl_mulai, $request->tgl_selesai]);
    }

    $rekapAbsensi = $query->orderBy('tanggal_absensi', 'desc')->get();
    // ----------------------------

    $summary = [
        'hadir' => $rekapAbsensi->where('status_absensi', 'hadir')->count(),
        'izin'  => $rekapAbsensi->where('status_absensi', 'izin')->count(),
        'sakit' => $rekapAbsensi->where('status_absensi', 'sakit')->count(),
        'alpha' => $rekapAbsensi->where('status_absensi', 'alpha')->count(),
    ];

    $data = [
        'nidn'         => $userSiswa->NIDN,
        'namasiswa'    => $userSiswa->nama,
        'nama_kelas'   => $kelasSiswa->nama_kelas ?? 'Semua Kelas',
        'rekapAbsensi' => $rekapAbsensi,
        'summary'      => $summary,
        'request'      => $request // Kirim request agar input filter tetap terisi (old value)
    ];

    return view('Murid.AbsensiView', $data);
}


public function penilaianView()
{
    // 1. Ambil data siswa yang sedang login
    $email = Auth::user()->email;
    $userSiswa = ModelUserBaru::where('email', $email)->first();

    if (!$userSiswa) {
        return redirect()->back()->with('error', 'Profil siswa tidak ditemukan.');
    }

    // 2. Ambil data kelas siswa
    $kelasSiswa = DB::table('db_kelas')
        ->where('id', $userSiswa->id_kelas)
        ->first();

    // 3. Ambil data penilaian milik siswa ini
    $penilaian = DB::table('tb_penilaian')
        ->where('id_siswa', $userSiswa->NIDN)
        ->orderBy('tahun_ajaran', 'desc')
        ->orderBy('semester', 'asc')
        ->get();

    // 4. Hitung rata-rata nilai untuk statistik kecil
    $rataRata = $penilaian->avg('nilai') ?? 0;

    $data = [
        'nidn'         => $userSiswa->NIDN,
        'namasiswa'    => $userSiswa->nama,
        'nama_kelas'   => $kelasSiswa->nama_kelas ?? 'Semua Kelas',
        'Penilaian'    => $penilaian,
        'rataRata'     => round($rataRata, 2)
    ];

    return view('Murid.NilaiView', $data);
}
}
