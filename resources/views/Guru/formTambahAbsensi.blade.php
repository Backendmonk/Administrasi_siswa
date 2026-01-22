@extends('layout.main')

@section('judul')
    Data Absensi
@endsection

@section('isi')
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Absensi</title>
    </head>
    <body>
       
      
            <main>
                <div class="card mb-5">
                <div class="card-body">
                  
                    
                    <form action="/Guru/prosesinputabsen" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Siswa / Siswi</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"  name = "nama_siswa" value="{{$namasiswa}}" readonly>

                            <input type="text" hidden name="nidn" value="{{$nidn}}">

                            <input type="text" hidden name="id_kelas" value="{{$id_kelas}}">

                            <label for="exampleInputPassword1">Kelas</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"  name = "nama_kelas" value="{{$nama_kelas}}" readonly>

                                <label for="exampleInputPassword1">Status Absensi</label>
                                <select name="status_absensi" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="alpha">Alpha</option>
                                </select>


                             <label for="exampleInputPassword1">Tanggal</label>
                            <input type="date"   class="form-control" id="exampleInputPassword1"  name = "tanggal"  >

                          </div>

                        <br>
                        <br>

                        <button type="submit" class="btn btn-primary" >Simpan</button>
                        
                        <button type="button" onclick="window.location='/Guru/AbsensiView'" class="btn btn-primary" >Kembali</button>
                     
                      </form>

                    
                          
                      
                   
                    
                    </div>
                </div>
                      </div>
                        
                </main>
    </body>
    </html>
@endsection
