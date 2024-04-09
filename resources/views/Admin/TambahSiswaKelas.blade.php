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
    <title>Data Siswa </title>
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

        <form method = "POST" action ="/adm/prosessiswakelas">
            @csrf
                
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>

                       
                        
                        @foreach ($datasiswa as $data)
                        <tr>
                            <td>{{$data->NIDN}}</td>
                            <td>{{$data->nama}}</td>
                            <td><div class="form-check">
                                <input class="form-check-input" name = "siswa" type="checkbox" value="{{$data->NIDN}}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                </label>
                              </div></td>
                           
                        </tr>
                        @endforeach
                       
                       
                    </tbody>
                </table>
                
                <button type="submit" class = "btn btn-primary"> Simpan</button>
           
       
            </div>
           
            
            
        </form>
      
    
  

    
</main>
</div>
</body>
</html>

  

@endsection
