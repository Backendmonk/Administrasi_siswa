@extends('layout.main')

@section('judul')
    Detail Nilai Siswa
@endsection

@section('isi')
<div class="container-fluid px-4">
    <div class="card mb-4 mt-3">
        <div class="card-header">
            <i class="fas fa-user-grad me-1"></i>
            <strong>Informasi Siswa</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td width="30%">Nama Siswa</td>
                            <td width="5%">:</td>
                            <td><strong>{{ $namasiswa }}</strong></td>
                        </tr>
                        <tr>
                            <td>NIDN/NISN</td>
                            <td>:</td>
                            <td>{{ $nidn }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td width="30%">Kelas</td>
                            <td>:</td>
                            <td>{{ $nama_kelas }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i> Daftar Nilai
            </div>
            <div class="d-flex align-items-center">
                <span class="me-2 text-muted small">Filter Mapel:</span>
                <select id="filterMapel" class="form-select form-select-sm" style="width: 200px;">
                    <option value="">Semua Mata Pelajaran</option>
                    @foreach ($Penilaian->unique('mata_pelajaran') as $p)
                        <option value="{{ $p->mata_pelajaran }}">{{ $p->mata_pelajaran }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-body">
            <table id="tabelNilaiSiswa" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Mata Pelajaran</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th width="15%">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Penilaian as $key => $item)
                        <tr class="row-nilai" data-mapel="{{ $item->mata_pelajaran }}">
                            <td>{{ $key + 1 }}</td>
                            <td class="col-mapel">{{ $item->mata_pelajaran }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>{{ $item->tahun_ajaran }}</td>
                            <td>
                                <center>
                                    <span class="badge {{ $item->nilai < 75 ? 'bg-danger' : 'bg-success' }}" style="font-size: 1rem;">
                                        {{ $item->nilai }}
                                    </span>
                                </center>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data nilai tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="mt-3">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterSelect = document.getElementById('filterMapel');
        const rows = document.querySelectorAll('.row-nilai');

        filterSelect.addEventListener('change', function() {
            const selectedMapel = this.value;

            rows.forEach(row => {
                const mapelInRow = row.getAttribute('data-mapel');
                
                if (selectedMapel === "" || mapelInRow === selectedMapel) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>

@if (session()->has('message'))
    <script>
        swal({ title: "Sukses!", text: "{{ session()->get('message') }}", icon: "success", button: "Tutup" });
    </script>
@endif
@endsection