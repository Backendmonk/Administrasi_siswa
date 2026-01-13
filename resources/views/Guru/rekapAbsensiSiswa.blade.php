@extends('layout.main')

@section('judul')
    Rekap Absensi Siswa
@endsection

@section('isi')
<style>
    /* JANGAN pakai flex agar footer tidak ketarik */
    .main-content-wrapper {
        min-height: calc(100vh - 150px); /* sesuaikan tinggi header + footer */
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

    {{-- INFORMASI SISWA --}}
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

    {{-- SUMMARY --}}
    <div class="row g-4 mb-4">
        @php
            $cards = [
                ['hadir','success'],
                ['izin','primary'],
                ['sakit','warning'],
                ['alpha','danger']
            ];
        @endphp

        @foreach ($cards as [$key,$color])
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 bg-{{ $color }} {{ $color=='warning'?'text-dark':'text-white' }} shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                    <h2 class="display-4 mb-0">{{ $summary[$key] ?? 0 }}</h2>
                    <div class="text-uppercase small fw-bold">{{ ucfirst($key) }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- RIWAYAT --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
            <div class="fw-bold text-secondary">
                <i class="fas fa-history me-1"></i> Riwayat Absensi
            </div>
            <select id="filterStatus" class="form-select form-select-sm" style="width:160px">
                <option value="">Semua Status</option>
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alpha">Alpha</option>
            </select>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr class="text-center text-secondary">
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rekapAbsensi as $key => $item)
                        <tr class="row-absensi text-center align-middle"
                            data-status="{{ strtolower($item->status_absensi) }}">
                          
                            <td class="text-start ps-5">
                                {{ \Carbon\Carbon::parse($item->tanggal_absensi)->translatedFormat('d F Y') }}
                            </td>
                            <td>
                                <span class="badge bg-{{ match(strtolower($item->status_absensi)){
                                    'hadir'=>'success','izin'=>'primary','sakit'=>'warning text-dark','alpha'=>'danger',default=>'secondary'
                                } }} px-3 py-2">
                                    {{ $item->status_absensi }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                Data absensi tidak ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">
                <i class="fa fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>



<script>
document.getElementById('filterStatus').addEventListener('change', function(){
    document.querySelectorAll('.row-absensi').forEach(row=>{
        row.style.display = (!this.value || row.dataset.status===this.value) ? '' : 'none';
    });
});
</script>
@endsection
