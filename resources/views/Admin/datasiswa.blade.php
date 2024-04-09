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
            <button type="submit" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i>Tambah Kelas</button>
    </form>
    <br>
    <br>
    <main>
      
    
  

    
</main>
</div>
</body>
</html>

  

@endsection
