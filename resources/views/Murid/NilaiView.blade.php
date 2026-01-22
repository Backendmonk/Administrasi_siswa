@extends('layout.main')

@section('judul')
    Detail Nilai Siswa
@endsection

@section('isi')
<style>
    .main-content-wrapper { min-height: calc(100vh - 160px); }
    .card { border-radius: 12px; border: none; }
    .badge-nilai { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 1.1rem; }
</style>

<div class="container-fluid px-4 pb-5 main-content-wrapper">
    
    {{-- INFORMASI SISWA & RATA-RATA --}}
    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-user-grad me-2"></i>Informasi Akademik</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 border-end">
                            <p class="text-muted small mb-1 text-uppercase">Nama Siswa</p>
                            <p class="fw-bold mb-3">{{ $namasiswa }}</p>
                            <p class="text-muted small mb-1 text-uppercase">NIDN/NISN</p>
                            <p class="text-primary fw-bold mb-0">{{ $nidn }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted small mb-1 text-uppercase ps-md-3">Kelas saat ini</p>
                            <p class="fw-bold mb-0 ps-md-3">{{ $nama_kelas }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm bg-primary text-white">
                <div class="card-body text-center py-4">
                    <p class="text-uppercase small mb-1 opacity-75">Rata-Rata Nilai</p>
                    <h1 class="display-4 fw-bold mb-0">{{ $rataRata }}</h1>
                    <small class="opacity-75">Dari total {{ $Penilaian->count() }} Mata Pelajaran</small>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL NILAI --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-secondary"><i class="fas fa-list-ol me-2"></i>Daftar Nilai</h5>
            
            <div class="d-flex align-items-center">
                <i class="fas fa-filter text-muted me-2"></i>
                <select id="filterMapel" class="form-select form-select-sm" style="width: 220px;">
                    <option value="">Semua Mata Pelajaran</option>
                    @foreach ($Penilaian->unique('mata_pelajaran') as $p)
                        <option value="{{ $p->mata_pelajaran }}">{{ $p->mata_pelajaran }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-center small text-uppercase text-secondary">
                        <tr>
                            <th>No</th>
                            <th class="text-start ps-4">Mata Pelajaran</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Penilaian as $key => $item)
                        <tr class="row-nilai text-center" data-mapel="{{ $item->mata_pelajaran }}">
                            <td>{{ $key + 1 }}</td>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark">{{ $item->mata_pelajaran }}</div>
                                <div class="text-muted small">ID Penilaian: #{{ $item->id ?? '-' }}</div>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $item->semester }}</span></td>
                            <td>{{ $item->tahun_ajaran }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <div class="badge-nilai {{ $item->nilai < 75 ? 'bg-danger-subtle text-danger border border-danger' : 'bg-success-subtle text-success border border-success' }}">
                                        {{ $item->nilai }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-book-open fa-3x mb-3 opacity-25"></i><br>
                                <p class="text-muted">Data nilai belum tersedia.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="card-footer bg-white py-3">
            <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div> --}}
    </div>
</div>
</div>

{{-- SCRIPT FILTER --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterSelect = document.getElementById('filterMapel');
        const rows = document.querySelectorAll('.row-nilai');

        filterSelect.addEventListener('change', function() {
            const selectedMapel = this.value;
            rows.forEach(row => {
                const mapelInRow = row.getAttribute('data-mapel');
                row.style.display = (selectedMapel === "" || mapelInRow === selectedMapel) ? "" : "none";
            });
        });
    });
</script>
@endsection