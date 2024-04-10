@extends('layout.main')

@section('judul')
    Edit Kelas
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

        <form method = "POST" action ="/adm/proseseditkelas">
            @csrf

            <div class="form-group">
                <label for="exampleInputPassword1">Wali Kelas</label>
                <select name = "walikelas" class="form-control form-control-lg">
                  <option value="null">--Pilih Wali Kelas--</option>
                  @foreach ($Dataguru as $data)
                      
                        <option value="{{$data->id}}">{{$data->id}}-{{$data->name}}</option>
                      
                  @endforeach              
                </select>
              </div>

              <div class="form-group">
                <input hidden type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name = "idkelas" value = {{$idkelas}}>
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
