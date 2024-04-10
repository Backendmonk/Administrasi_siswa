@extends('layout.main')

@section('judul')
    Data Siswa Baru
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
       
      
            <main>
                <div class="card mb-5">
                <div class="card-body">
                    
                    <form action="/adm/inputdata" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">NIDN</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"  name = "nidn">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"  name = "nama">
                          </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name = "tgllahir">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" id="exampleRadios1" value="laki-laki" >
                                <label class="form-check-label" for="exampleRadios1">
                                 Laki-Laki
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" id="exampleRadios2" value="perempuan">
                                <label class="form-check-label" for="exampleRadios2">
                                  Perempuan
                                </label>
                              </div>
                          </div>


                          <div class="form-group">
                            <label for="exampleInputEmail1">Asal Sekolah</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="asalsklh" >
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="alamat" >
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Seleksi</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="seleksi" id="exampleRadios1" value="Mandiri" >
                                <label class="form-check-label" for="exampleRadios1">
                                Mandiri
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="seleksi" id="exampleRadios2" value="Reguler">
                                <label class="form-check-label" for="exampleRadios2">
                                 Reguler
                                </label>
                              </div>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Nama Orang Tua</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="namaOrtu" >
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Pekerjaan Orang Tua</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="pekerjaanortu" >
                          </div>


                        <div class="form-group">
                          <label for="exampleInputPassword1"></label>
                          <input type="password" hidden class="form-control" id="exampleInputPassword1" >
                        </div>
                       

                        <button type="submit" class="btn btn-primary" >Simpan</button>
                        
                        <button type="button" onclick="window.location='/adm/siswabaru'" class="btn btn-primary" >Kembali</button>
                     
                      </form>
                    
                          
                      
                   
                    
                    </div>
                </div>
                      </div>
           
            </main>
    </body>
    </html>
@endsection
