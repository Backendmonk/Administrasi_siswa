@extends('layout.main')

@section('judul')
    Data Siswa Baru
@endsection

@section('isi')

{{-- 
<div>
    <!-- alert tambah data-->
    @if (session()->has('message'))
    <div class="alert alert-warning"  id ="alert">
        <button type="Button" class="close" data-dismiss = "alert">x</button>
          
    
    
  </div>
    @endif

</div>

<div>
        <!-- alert Hapus error-->
    @if (session()->has('error'))
    <div class="alert alert-warning"  id ="alert">
        <button type="Button" class="close" data-dismiss = "alert">x</button>
     
    </div>
        
    @endif
</div> --}}
    
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
        <form action="/adm/muridbaru_view" method="get">
                <button type="submit" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i>Tambah Murid</button>
        </form>
        <br>
        <br>
        <main>
          
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Siswa Baru
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Asal Sekolah</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>

                       
                        
                        @foreach ($SiswaData as $data)
                        <tr>
                            <td>{{$data->NIDN}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->jeniskelamin}}</td>
                            <td>{{$data->asal_sekolah}}</td>
                            <td><button type="button" class ="btn btn-warning" onclick="window.location='/adm/editSiswa/{{$data->NIDN}}'"> <i class="fa fa-gear"></i></button> | <button type="button" class ="btn btn-danger"> <i class="fa fa-trash" onclick="window.location='/adm/delete_siswa/{{$data->NIDN}}'"></i></button></td>
                           
                        </tr>
                        @endforeach
                       
                       
                    </tbody>
                </table>

           
       
            </div>
        </div>
        </div>
   
        
    </main>

    </body>
    </html>

@endsection
