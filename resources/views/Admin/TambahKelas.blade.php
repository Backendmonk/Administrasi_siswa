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
   <br>
    <main>

        <form method = "POST" action ="/adm/proseskelas">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Nomor Kelas</label>
              <select class="form-control form-control-lg">
                <option value="null">--Pilih Grade Kelas--</option>
                @for ($i = 7; $i < 10; $i++)
                
                <option value ="{{$i}}" >{{$i}}</option>
                    
                @endfor
                
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Kode Kelas</label>
              <select class="form-control form-control-lg">
                <option value="null">--Pilih Kode Kelas--</option>
                <option value ="A" >A</option>  
                <option value ="B" >B</option>  
                <option value ="C" >C</option>              
              </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" onclick="window.location='/adm/datasiswa'" class="btn btn-primary" >Kembali</button>
          </form>
      
    
  

    
</main>
</div>
</body>
</html>

  

@endsection
