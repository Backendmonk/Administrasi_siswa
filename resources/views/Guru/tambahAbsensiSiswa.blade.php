@extends('layout.main')

@section('judul')
    Rekap Absensi Siswa
@endsection

@section('isi')
<style>
    /* Gunakan vh (viewport height) agar konten mendorong footer ke bawah */
    .main-content-wrapper {
        min-height: 75vh; 
        display: flex;
        flex-direction: column;
    }
    
    .display-4 {
        font-size: 2.5rem;
        font-weight: 700;
    }

    .card { 
        border-radius: 10px; 
        overflow: hidden; 
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,.03);
        transition: 0.2s;
    }
</style>

<div class="container-fluid px-4 pb-4 main-content-wrapper">
    <div class="card mb-4 mt-3 shadow-sm">
        <div class="card-header bg-light">
            <i class="fas fa-user-circle me-1"></i>
            <strong>Informasi Siswa</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 border-end">
                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted">Nama Siswa</div>
                        <div class="col-sm-8">: <strong>{{ $namasiswa }}</strong></div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-sm-4 text-muted">NIDN/NISN</div>
                        <div class="col-sm-8 text-primary">: {{ $nidn }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted ps-md-4">Kelas</div>
                        <div class="col-sm-8">: {{ $nama_kelas }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 bg-success text-white shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                    <h2 class="display-4 mb-0">{{ $summary['hadir'] ?? 0 }}</h2>
                    <div class="text-uppercase small fw-bold">Hadir</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 bg-primary text-white shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                    <h2 class="display-4 mb-0">{{ $summary['izin'] ?? 0 }}</h2>
                    <div class="text-uppercase small fw-bold">Izin</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 bg-warning text-dark shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                    <h2 class="display-4 mb-0">{{ $summary['sakit'] ?? 0 }}</h2>
                    <div class="text-uppercase small fw-bold">Sakit</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 bg-danger text-white shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                    <h2 class="display-4 mb-0">{{ $summary['alpha'] ?? 0 }}</h2>
                    <div class="text-uppercase small fw-bold">Alpha</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
            <div class="fw-bold text-secondary">
                <i class="fas fa-history me-1"></i> Riwayat Absensi
            </div>
            <div class="d-flex align-items-center">
                <label for="filterStatus" class="me-2 text-muted small">Filter:</label>
                <select id="filterStatus" class="form-select form-select-sm" style="width: 160px;">
                    <option value="">Semua Status</option>
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="alpha">Alpha</option>
                </select>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr class="text-center text-secondary">
                            <th width="80px">No</th>
                            <th>Tanggal Absensi</th>
                            <th width="200px">Status Absensi</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTabelAbsen">
                        @forelse ($rekapAbsensi as $key => $item)
                        <tr class="row-absensi text-center align-middle" data-status="{{ strtolower($item->status_absensi) }}">
                            <td class="fw-bold">{{ $key + 1 }}</td>
                            <td class="text-start ps-5">{{ \Carbon\Carbon::parse($item->tanggal_absensi)->translatedFormat('d F Y') }}</td>
                            <td>
                                @php
                                    $status = strtolower($item->status_absensi);
                                    $badge = match($status) {
                                        'hadir' => 'bg-success',
                                        'izin'  => 'bg-primary',
                                        'sakit' => 'bg-warning text-dark',
                                        'alpha' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badge }} px-3 py-2 text-uppercase" style="width: 85px; font-size: 0.75rem;">
                                    {{ $item->status_absensi }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-5 text-center text-muted italic">Data absensi tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary shadow-sm">
                <i class="fa fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

 <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterStatus = document.getElementById('filterStatus');
        const rows = document.querySelectorAll('.row-absensi');

        filterStatus.addEventListener('change', function() {
            const selectedStatus = this.value;
            rows.forEach(row => {
                const statusInRow = row.getAttribute('data-status');
                row.style.display = (selectedStatus === "" || statusInRow === selectedStatus) ? "" : "none";
            });
        });
    });
</script>
@endsection