@extends('layout.main')

@section('judul')
    Index Guru
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


        <br>
        
        
                
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nama Mata Pelajaran</th>
                           
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                    

                        @foreach ($mapel as $data)
                            
                        <tr>
                            <td>{{$data->nama_pelajaran}}</td>
                             
                            <td>

                                <form action="/Guru/forminputnilai" method = "POST">
                                    @csrf
                                        
                                    <input name = "id" type="text" hidden value={{$data->NIDN}}>
                                    <input type="text" name ="namasiswa" hidden value={{$data->nama_siswa}}>
                                    

                                    <button type="submit" class = "btn btn-primary"> <i class = "fa fa-plus"></i> Tambah Nilai</button>
                                </form>
        
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
