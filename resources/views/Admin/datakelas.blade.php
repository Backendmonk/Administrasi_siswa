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
            @if ($data->StatusKelas == 'NonAktif')
                 <div class="card bg-secondary text-white mb-4">
                    
                        
            @else
                      <div class="card bg-success text-white mb-4">   
                    
            @endif
           
                
                <div class="card-body"><center>Kelas : {{$data->nama_kelas}} - Status {{ $data->StatusKelas }}</center></div>
                <div class="card-body"><center>Wali Kelas : {{$data->Nama_wali}}</center></div>
               
                
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/adm/tambahSiswaKelas/{{$data->id}}">Tambah Siswa</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
            <div class="card-body d-flex gap-2">
            <div class="card-body">
                
                <form action="/adm/datasiswakelas/{{$data->id}}" method="get">
                    @csrf
                    <button class = "btn btn-warning" type="submit" >
                <center><i class = "fa fa-users"></i>Data Siswa</button></center></div>
                </form>
                @if ($data->StatusKelas == 'NonAktif')

                    @else
                    <form action="/adm/nonaktifkanKelas" method="get">
                    @csrf
                    <input type="text" hidden value="{{ $data->id }}">
                    <button class = "btn btn-danger" type="submit" >
                <center><i class = "fa fa-warning"></i>Nonaktifkan Kelas</button></center></div>
                </form>

                    @endif
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
