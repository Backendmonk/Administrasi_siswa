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
                    

                        @foreach ($id_kelas as $data)
                            
                        <tr>
                            <td>{{$data->NIDN}}</td>
                            <td>{{$data->nama_siswa}}</td>    
                            <td>

                                <form action="/Guru/tambahNilaimapel" method = "POST">
                                    @csrf

                                    <input name = "nidn" type="text" hidden value={{$data->NIDN}}>
                                    <input type="text" name ="namasiswa" hidden value={{$data->nama_siswa}}>
                                    <input hidden type="text" name ="id_kelas"  value={{$id_kelas2->id}}>
                                    <input hidden type="text" name ="nama_kelas"  value={{$id_kelas2->nama_kelas}}>
                                    

                                    <button type="submit" class = "btn btn-primary"> <i class = "fa fa-plus"></i> Tambah Nilai</button>
                                </form>
                                <br>


                                <form action="/Guru/lihatNilai" method = "POST">
                                    @csrf

                                     <input name = "nidn" type="text" hidden value={{$data->NIDN}}>
                                    <input type="text" name ="namasiswa" hidden value={{$data->nama_siswa}}>
                                    <input hidden type="text" name ="id_kelas"  value={{$id_kelas2->id}}>
                                    <input hidden type="text" name ="nama_kelas"  value={{$id_kelas2->nama_kelas}}>

                                    <button type="submit" class = "btn btn-success"> <i class = "fa fa-eye"></i> Lihat Nilai</button>
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
