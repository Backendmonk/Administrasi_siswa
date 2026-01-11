@extends('layout.main')

@section('judul')
    Data Mata Pelajaran
@endsection

@section('isi')
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Mata Pelajaran</title>
    </head>
    <body>
       
      
            <main>
                <div class="card mb-5">
                <div class="card-body">
                    @php
                        $rand= rand(1000,9999);
                    @endphp
                    
                    <form action="/adm/MapelAddProses" method="POST">
                        @csrf
                        <input type="text" hidden name = "id" value = "{{$rand}}">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Mata pelajaran</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"  name = "nama_mapel">
                          </div>

                        <br>
                        <br>

                        <button type="submit" class="btn btn-primary" >Simpan</button>
                        
                        <button type="button" onclick="window.location='/adm/Mapel'" class="btn btn-primary" >Kembali</button>
                     
                      </form>

                    
                          
                      
                   
                    
                    </div>
                </div>
                      </div>
           
            </main>
    </body>
    </html>
@endsection
