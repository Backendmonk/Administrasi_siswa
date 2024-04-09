@extends('layout.main')

@section('judul')
    Data Siswa
@endsection

@section('isi')
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Siswa Baru</title>
</head>
<body>

    @if (session()->has('message'))
        <script>
            swal({
            title: "Sukses!",
            text:  "{{session()->get('message')}}",
            icon: "success",
            button: "Tutup",
            });
        </script>
    @endif


    
    @if (session()->has('delete'))
        <script>
            swal({
            title: "Sukses",
            text:  "{{session()->get('delete')}}",
            icon: "success",
            button: "Tutup",
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            swal({
            title: "Error",
            text:  "{{session()->get('error')}}",
            icon: "error",
            button: "Tutup",
            });
        </script>
    @endif
    <br>
    <form action="/adm/kelassAdd" method="get">
            <button type="submit" class="btn btn-primary"><i class="fa fa-building" aria-hidden="true"></i> Tambah Kelas</button>
    </form>
    <br>
    <br>
    <main>
        <div class="row">
        @foreach ($DataKelas as $data)

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><center>Kelas : {{$data->nama_kelas}}</center></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/adm/tambahSiswaKelas">Tambah Siswa</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
            
        @endforeach
    </div>
      
    
  

    
</main>
</div>
</body>
</html>

  

@endsection
