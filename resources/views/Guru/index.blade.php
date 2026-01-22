@extends('layout.main')

@section('judul')
    Dashboard Guru
@endsection

@section('isi')
<div class="container-fluid px-4">
    <div class="card mb-4 mt-3 bg-primary text-white border-0 shadow-sm">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div>
                <h2 class="fw-bold mb-1">Selamat Datang, Guru! 👋</h2>
                <p class="mb-0 opacity-75">Hari ini adalah {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}. Siap untuk mengajar?</p>
            </div>
            <div class="d-none d-md-block">
                <i class="fas fa-chalkboard-teacher fa-4x opacity-25"></i>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-xl-4 col-md-6">
            <div class="card bg-white border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-info-subtle p-3 me-3 text-info">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Total Siswa</div>
                        <h3 class="mb-0 fw-bold text-dark">{{ $total_siswa }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-white border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning-subtle p-3 me-3 text-warning">
                        <i class="fas fa-school fa-2x"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Total Kelas</div>
                        <h3 class="mb-0 fw-bold text-dark">{{ $total_kelas }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card bg-white border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success-subtle p-3 me-3 text-success">
                        <i class="fas fa-user-check fa-2x"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Absen Hari Ini</div>
                        <h3 class="mb-0 fw-bold text-dark">{{ $absen_hari_ini }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4 h-100">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold text-secondary"><i class="fas fa-history me-2"></i>Absensi Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th class="text-end pe-3">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_absensi as $ra)
                                <tr>
                                    <td class="ps-3 fw-bold text-dark">{{ $ra->nama_siswa }}</td>
                                    <td>{{ $ra->nama_kelas }}</td>
                                    <td>
                                        <span class="badge {{ strtolower($ra->status_absensi) == 'hadir' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $ra->status_absensi }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-3 text-muted small">{{ \Carbon\Carbon::parse($ra->created_at)->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada aktivitas hari ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        


<style>
    /* Tambahan agar dashboard makin cantik */
    .bg-info-subtle { background-color: #e0f7fa; }
    .bg-warning-subtle { background-color: #fff9c4; }
    .bg-success-subtle { background-color: #e8f5e9; }
    .card { transition: transform 0.2s; }
    .card:hover { transform: translateY(-5px); }
</style>
@endsection