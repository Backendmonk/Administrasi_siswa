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
                    
                    <form action="/adm/updatesiswa" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="text" hidden  name = "nidn" value={{$nidn}}>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" value = {{$nama}}  name = "nama">
                          </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value = {{$email}}  name="email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value = {{date('Y-m-d',strtotime($tgl))}}   name = "tgllahir">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            @if ($jk =="Laki-Laki")
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" id="exampleRadios1" value="laki-laki" checked >
                                <label class="form-check-label" for="exampleRadios1">
                                 Laki-Laki
                                </label>
                              </div>

                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" id="exampleRadios2" value="perempuan" >
                                <label class="form-check-label" for="exampleRadios2">
                                  Perempuan
                                </label>
                              </div>
                              @endif
                            
                        
                            @if ($jk =="Perempuan")
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" id="exampleRadios1" value="laki-laki"  >
                                <label class="form-check-label" for="exampleRadios1">
                                 Laki-Laki
                                </label>
                              </div>

                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" id="exampleRadios2" value="perempuan" checked>
                                <label class="form-check-label" for="exampleRadios2">
                                  Perempuan
                                </label>
                            </div>
                                
                           
                            @endif
                           

                             
                          </div>


                          <div class="form-group">
                            <label for="exampleInputEmail1">Asal Sekolah</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="asalsklh" value = "asal_sekolah" >
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="alamat" value = "alamat">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Seleksi</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="seleksi" id="exampleRadios1" value="ujian" >
                                <label class="form-check-label" for="exampleRadios1">
                                 Ujian Entah
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="seleksi" id="exampleRadios2" value="dunno">
                                <label class="form-check-label" for="exampleRadios2">
                                 I Dunno
                                </label>
                              </div>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Nama Orang Tua</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="namaOrtu" value = "nama_orangtua">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Pekerjaan Orang Tua</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="pekerjaanortu" value = "pekerjaanortu">
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
