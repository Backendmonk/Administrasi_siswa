@extends('layout.main')

@section('judul')
   
@endsection

@section('isi')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="fw-bold">Ringkasan Data Siswa</h3>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5>Total Siswa</h5>
                    <h2>{{ $totalSiswa }}</h2>
                    <small>Siswa terdaftar di database</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Laki-Laki</h5>
                    <h2>{{ $lakiLaki }}</h2>
                    <small>Jumlah siswa putra</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h5>Perempuan</h5>
                    <h2>{{ $perempuan }}</h2>
                    <small>Jumlah siswa putri</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Bagian Grafik --}}
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0 font-weight-bold text-dark">Siswa Berdasarkan Asal Sekolah</h5>
                </div>
                <div class="card-body">
                    <canvas id="siswaAsalSekolahChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0 font-weight-bold text-dark">Siswa Berdasarkan Jenis Kelamin</h5>
                </div>
                <div class="card-body">
                    <canvas id="siswaJenisKelaminChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0 font-weight-bold text-dark">Pendaftaran Siswa Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>NIDN</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Asal Sekolah</th>
                                    <th>Seleksi</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswaTerbaru as $siswa)
                                <tr>
                                    <td><strong>{{ $siswa->NIDN }}</strong></td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>
                                        <span class="badge {{ $siswa->jeniskelamin == 'Laki-Laki' ? 'bg-primary' : 'bg-danger' }}">
                                            {{ $siswa->jeniskelamin }}
                                        </span>
                                    </td>
                                    <td>{{ $siswa->asal_sekolah }}</td>
                                    <td>{{ $siswa->seleksi }}</td>
                                    {{-- <td>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">Detail</a>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts') {{-- Tambahkan section scripts di layout.main --}}
<script>
    // Data dari Controller Laravel
    const labelsSekolah = @json($labelsSekolah);
    const dataSekolah = @json($dataSekolah);
    const labelsJenisKelamin = @json($labelsJenisKelamin);
    const dataJenisKelamin = @json($dataJenisKelamin);

    // --- Grafik Siswa Berdasarkan Asal Sekolah (Bar Chart) ---
    const ctxSekolah = document.getElementById('siswaAsalSekolahChart').getContext('2d');
    new Chart(ctxSekolah, {
        type: 'bar', // Bisa 'bar', 'horizontalBar', 'line', 'doughnut', 'pie'
        data: {
            labels: labelsSekolah,
            datasets: [{
                label: 'Jumlah Siswa',
                data: dataSekolah,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Siswa'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Asal Sekolah'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false // Tidak perlu legend jika hanya ada 1 dataset
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y + ' siswa';
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });

    // --- Grafik Siswa Berdasarkan Jenis Kelamin (Pie Chart) ---
    const ctxJenisKelamin = document.getElementById('siswaJenisKelaminChart').getContext('2d');
    new Chart(ctxJenisKelamin, {
        type: 'pie', // Pie chart lebih cocok untuk persentase
        data: {
            labels: labelsJenisKelamin,
            datasets: [{
                label: 'Jumlah Siswa',
                data: dataJenisKelamin,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)', // Biru untuk Laki-Laki
                    'rgba(255, 99, 132, 0.8)'  // Merah untuk Perempuan
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed !== null) {
                                label += context.parsed + ' siswa';
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection