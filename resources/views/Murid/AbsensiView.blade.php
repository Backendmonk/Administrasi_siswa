@extends('layout.main')

@section('judul')
    Rekap Absensi Siswa
@endsection

@section('isi')
<style>
    /* Menjaga footer tetap di bawah tanpa merusak layout */
    .main-content-wrapper {
        min-height: calc(100vh - 160px);
    }
    
    .display-4 {
        font-size: 2.5rem;
        font-weight: 700;
    }

    .card { 
        border-radius: 12px; 
        overflow: hidden;
        border: none;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,.03);
        transition: 0.2s;
    }

    .badge-status {
        width: 85px;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    /* Styling Filter Area */
    .filter-box {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
    }
</style>

<div class="container-fluid px-4 pb-5 main-content-wrapper">

    {{-- SECTION 1: INFORMASI SISWA --}}
    <div class="card mb-4 mt-3 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-primary">
                <i class="fas fa-user-circle me-2"></i>Informasi Siswa
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 border-end">
                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted small text-uppercase fw-bold">Nama Siswa</div>
                        <div class="col-sm-8">: <strong>{{ $namasiswa }}</strong></div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-sm-4 text-muted small text-uppercase fw-bold">NIDN/NISN</div>
                        <div class="col-sm-8 text-primary">: {{ $nidn }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted ps-md-4 small text-uppercase fw-bold">Kelas</div>
                        <div class="col-sm-8">: {{ $nama_kelas }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 2: RINGKASAN STATISTIK --}}
    <div class="row g-4 mb-4">
        @php
            $cards = [
                ['hadir', 'success', 'fas fa-check-double'],
                ['izin', 'primary', 'fas fa-envelope-open-text'],
                ['sakit', 'warning', 'fas fa-first-aid'],
                ['alpha', 'danger', 'fas fa-user-times']
            ];
        @endphp

        @foreach ($cards as [$key, $color, $icon])
        <div class="col-xl-3 col-md-6">
            <div class="card bg-{{ $color }} {{ $color == 'warning' ? 'text-dark' : 'text-white' }} shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between py-4 px-4">
                    <div>
                        <h2 class="display-4 mb-0">{{ $summary[$key] ?? 0 }}</h2>
                        <div class="text-uppercase small fw-bold opacity-75">{{ $key }}</div>
                    </div>
                    <i class="{{ $icon }} fa-3x opacity-25"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- SECTION 3: RIWAYAT & FILTER --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h5 class="mb-0 fw-bold text-secondary">
                        <i class="fas fa-calendar-alt me-2"></i>Riwayat Absensi
                    </h5>
                </div>
                {{-- Form Filter Server-side (Bulan & Tahun) --}}
                <div class="col-md-8">
                    <form action="{{ url()->current() }}" method="GET" class="row g-2 justify-content-md-end">
                        <div class="col-auto">
                            <select name="bulan" class="form-select form-select-sm border-primary">
                                <option value="">Semua Bulan</option>
                                @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <select name="tahun" class="form-select form-select-sm border-primary">
                                @for($y = date('Y'); $y >= date('Y')-2; $y--)
                                    <option value="{{ $y }}" {{ request('tahun', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-sm btn-primary px-3">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                            <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-undo"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            {{-- Filter Status Client-side (Instant) --}}
            <div class="bg-light px-4 py-2 border-bottom d-flex align-items-center justify-content-end">
                <label class="small fw-bold text-muted me-2"><i class="fas fa-filter small"></i> Status:</label>
                <select id="filterStatus" class="form-select form-select-sm shadow-none" style="width: 140px;">
                    <option value="">Tampilkan Semua</option>
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="alpha">Alpha</option>
                </select>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-center small text-uppercase text-secondary">
                        <tr>
                            <th width="10%">No</th>
                            <th width="45%" class="text-start ps-5">Tanggal Absensi</th>
                            <th width="45%">Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse ($rekapAbsensi as $index => $item)
                        <tr class="row-absensi text-center" data-status="{{ strtolower($item->status_absensi) }}">
                            <td class="text-muted small">{{ $index + 1 }}</td>
                            <td class="text-start ps-5 fw-bold text-dark">
                                {{ \Carbon\Carbon::parse($item->tanggal_absensi)->translatedFormat('l, d F Y') }}
                            </td>
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
                                <span class="badge {{ $badge }} badge-status py-2">
                                    {{ strtoupper($item->status_absensi) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i><br>
                                    Belum ada riwayat absensi pada periode ini.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-chevron-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
</div>

{{-- SCRIPT FILTER --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterStatus = document.getElementById('filterStatus');
        const rows = document.querySelectorAll('.row-absensi');

        filterStatus.addEventListener('change', function() {
            const selectedStatus = this.value.toLowerCase();
            
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                if (selectedStatus === "" || status === selectedStatus) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>
@endsection