@extends('layout.main')

@section('judul')
    Data Guru
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

        @if (session()->has('success'))
            <script>
                swal({
                title: "Sukses!",
                text:  "{{session()->get('success')}}",
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
        <form action="/adm/Guru_account" method="get">
            @csrf
                <button type="submit" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i>Tambah Akun Guru</button>
        </form>
        <br>
        <br>
        <main>
          
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Guru
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>

                       
                        
                        @foreach ($dataGuru as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->role}}</td>
                           <td>
                                <form action="/toolsAdmin/Guru" method="get">
                                    @csrf   
                                    <input type="text" hidden name="id" value ="{{$data->id}}">

                                    <button type="submit" name = "edit"  value = "edit" class ="btn btn-warning"> <i class="fa fa-gear"></i></button> | <button type="submit" name ="delete" value = "delete" class ="btn btn-danger"> <i class="fa fa-trash"></i></button>


                                </form>
                            </td>
                           
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
