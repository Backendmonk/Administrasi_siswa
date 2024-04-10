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

        <h5>Wali Kelas : {{$namaguru}}</h5>
        <br>

        <form action="/adm/editkelas/{{$idkelas}}" method="GET">
            @csrf
           
            
            <button type="submit" class="btn btn-warning">Edit</button>
            
        </form>
        <br>
        
        
                
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
                            <td>  <button type="submit" class = "btn btn-primary"> <i class = "fa fa-add"></i> Tambah Siswa</button>
                            </td>
                           
                        </tr>
                        @endforeach
                        
                       
                       
                    </tbody>
                </table>
                
              
           
       
            </div>
           
            
            
    
      
    
  

    
</main>
</div>
</body>
</html>

  

@endsection
