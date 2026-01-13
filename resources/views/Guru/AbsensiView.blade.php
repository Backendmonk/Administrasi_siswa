@extends('layout.main')

@section('judul')
    Kelola Absensi
@endsection

@section('isi')
    
  @if (session()->has('success'))
        <script>
            swal({
            title: "Sukses!",
            text:  "{{session()->get('message')}}",
            icon: "success",
            button: "Tutup",
            });
        </script>
    @endif
<style>

    
    .kelas-card {
        border: none;
        border-radius: 4px; /* kotak, sedikit saja */
        height: 100%;
        transition: transform 0.2s ease;
    }

    .kelas-card:hover {
        transform: translateY(-3px);
    }

    .kelas-card.aktif {
        background: #198754;
        color: #fff;
    }

    .kelas-card.nonaktif {
        background: #6c757d;
        color: #fff;
    }

    .kelas-header {
        padding: 14px 16px;
        font-weight: 600;
        font-size: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }

    .kelas-body {
        padding: 16px;
        font-size: 14px;
    }

    .kelas-footer {
        padding: 14px 16px;
        background: rgba(0,0,0,0.08);
        display: grid;
        gap: 8px;
    }

    .btn-flat {
        border-radius: 3px;
        font-size: 13px;
        font-weight: 500;
    }
</style>

{{-- ALERT --}}
@if (session('message'))
<script>
    swal("Sukses", "{{ session('message') }}", "success");
</script>
@endif

@if (session('delete'))
<script>
    swal("Sukses", "{{ session('delete') }}", "success");
</script>
@endif

@if (session('error'))
<script>
    swal("Error", "{{ session('error') }}", "error");
</script>
@endif

<div class="container-fluid mt-4">

    </div>

    <div class="row g-3">

        @foreach ($DataKelas as $data)

        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
            <div class="kelas-card 
                {{ $data->StatusKelas == 'NonAktif' ? 'nonaktif' : 'aktif' }}">

                <div class="kelas-header">
                    Kelas {{ $data->nama_kelas }}
                </div>

                <div class="kelas-body">
                    <div class="mb-1">
                        <strong>Wali Kelas</strong>
                    </div>
                    <div>
                        {{ $data->Nama_wali }}
                    </div>

                    <div class="mt-2">
                        Status : 
                        <strong>{{ $data->StatusKelas }}</strong>
                    </div>
                </div>

                <div class="kelas-footer">
                     @if ($data->StatusKelas != 'NonAktif')
                        
                        <form action="/Guru/tambahAbsensi" method="get" >
                            @csrf
                            <input type="text" hidden name = "id_kelas" value = "{{$data->id}}">
                            <button type="submit"
                                class="btn btn-warning btn-flat">
                                <i class="fa fa-user-plus"></i> Tambah Absensi

                        </form>
                       
                      
                    @endif

                  

                   

                </div>
            </div>
        </div>

        @endforeach

    </div>
</div>

</div>
@endsection
