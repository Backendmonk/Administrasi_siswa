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
        <title>Data Nilai</title>
    </head>
    <body>
       
      
            <main>
                <div class="card mb-5">
                <div class="card-body">
                  
                    
                    <form action="/Guru/prosesinputnilai" method="POST">
                        @csrf
                        <input type="text" hidden name = "id" value = "{{$id_mapel}}">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Siswa / Siswi</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"  name = "nama_siswa" value="{{$namasiswa}}" readonly>

                            <input type="text" hidden name="nidn" value="{{$nidn}}">

                            <input type="text" hidden name="id_kelas" value="{{$id_kelas}}">

                            <label for="exampleInputPassword1">Kelas</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"  name = "nama_kelas" value="{{$nama_kelas}}" readonly>


                            <label for="exampleInputPassword1">Nama Mata pelajaran</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"  name = "mapel" value="{{$mapel}}" readonly>

                            <input type="text" hidden name = "id_mapel" value = "{{$id_mapel}}">


                             <label for="exampleInputPassword1">Tahun Ajaran </label>
                            <select name="tahun_ajaran" class="form-control">
                                    <option value="">-- Pilih Tahun Ajaran --</option>
                                    @php
                                        $tahunsekarang = date('Y');
                                        $tahunstart = 2021;
                                    @endphp

                                    @for ($i = $tahunstart; $i <= $tahunsekarang; $i++)
                                        @php 
                                            $tahunakhir = $i + 1; 
                                            $label = $i . '/' . $tahunakhir;
                                        @endphp
                                        
                                        {{-- Pastikan value menggunakan tanda kutip agar tidak terpotong jika ada spasi --}}
                                        <option value="{{ $label }}">
                                            {{ $label }}
                                        </option>
                                    @endfor
                                </select>


                                <label for="exampleInputPassword1">Semester</label>
                                <select name="semester" class="form-control">
                                    <option value="">-- Pilih Semester --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>


                             <label for="exampleInputPassword1">Nilai</label>
                            <input type="number"  step = "any" class="form-control" id="exampleInputPassword1"  name = "nilai"  >

                          </div>

                        <br>
                        <br>

                        <button type="submit" class="btn btn-primary" >Simpan</button>
                        
                        <button type="button" onclick="window.location='/Guru/penilaianView'" class="btn btn-primary" >Kembali</button>
                     
                      </form>

                    
                          
                      
                   
                    
                    </div>
                </div>
                      </div>
                        
                </main>
    </body>
    </html>
@endsection
