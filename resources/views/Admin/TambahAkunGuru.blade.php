@extends('layout.main')

@section('judul')
    Data Guru Baru
@endsection

@section('isi')
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Guru Baru</title>
    </head>
    <body>
       
      
            <main>
                <div class="card mb-5">
                <div class="card-body">
                    @php
                        $rand= rand(1000,9999);
                    @endphp
                    
                    <form action="/adm/inputdataGuru" method="POST">
                        @csrf
                        <input type="text" hidden name = "id" value = "{{$rand}}">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Guru</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"  name = "nama_guru">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" class="form-control" id="exampleInputPassword1"  name = "email">
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Password</label>
                          <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="password">
                        </div>     
                        
                        <br>
                        <br>

                        <button type="submit" class="btn btn-primary" >Simpan</button>
                        
                        <button type="button" onclick="window.location='/adm/dataguru'" class="btn btn-primary" >Kembali</button>
                     
                      </form>

                    
                          
                      
                   
                    
                    </div>
                </div>
                      </div>
           
            </main>
    </body>
    </html>
@endsection
