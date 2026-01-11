@extends('layout.main')

@section('judul')
    Data Mata Pelajaran
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
        <form action="/adm/MapelAddView" method="get">
            @csrf
                <button type="submit" class="btn btn-primary"><i class="fa fa-book" aria-hidden="true"></i>  Tambah Mata Pelajaran</button>
        </form>
        <br>
        <br>
        <main>
          
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Mapel
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            
                            <th>Nama Mapel</th>
                            <th>Aksi</th>
                           
                        </tr>
                    </thead>
                    <tbody>

                       
                        
                        @foreach ($datamapel as $data)
                        <tr>
                            <td>{{$data->nama_pelajaran}}</td>
                           
                           <td>
                                <form action="/toolsAdmin/Mapel" method="get">
                                    @csrf   
                                    <input type="text" hidden name="id" value ="{{$data->id}}">

                                     <button type="submit" name ="delete" value = "delete" class ="btn btn-danger"> <i class="fa fa-trash"></i></button>


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
