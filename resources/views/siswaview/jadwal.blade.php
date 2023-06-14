@extends('layouts.siswa')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          
          <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <!-- tidak di isi -->
            </div>
            
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid ">
        <div class="col-md-14 mt-4">
            <div class="card">
              <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center" id="daftar">
                <h4 class="mb-0">Daftar Jadwal Anda</h4>
                <a class="btn btn-primary" id="tambah-jadwal" onclick="tampilkanForm()">Tambah Jadwal</a>
              </div>
              <div class="card-body pt-17 p-3">
                <form id="form-jadwal" action="/siswatambahJadwal" method="POST" style="display: none;">
                  @csrf
                  {{-- <div class="form-group">
                    <label for="nama-siswa">Nama Siswa:</label>
                    <input type="text" class="form-control" name="siswa_id" value="{{ $namasiswa }}" readonly>
                  </div> --}}
                  <div class="form-grou">
                    <label for="layanan" class="form-label">Pilih layanan</label>
                    <select class="form-select" id="layanan" name="layanan_id">
                      <option value="">-- Pilih Layanan --</option>
                      @foreach ($layanan as $layanan)
                        <option value="{{$layanan->id}}">{{$layanan->jenis_layanan}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                  </div>
                  <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="time" class="form-control" id="waktu" name="waktu">
                  </div>
                  <div class="mb-3">
                    <label for="tempat" class="form-label">Tempat</label>
                    <input type="text" class="form-control" id="tempat" name="tempat">
                  </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="button"  onclick="kembali()" class="btn btn-secondary">kembali</button>
                </form>
                <ul class="list-group" id="list-jadwal">
                  @foreach ($jadwalbk as $item)
                  <li i class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                    <table border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td><label for="">Status </label></td>
                        <td>: <span class="p-1 rounded" style="display: inline-block; width: max-content;font-weight: bold; color: white; background-color: {{ ($item->status === 'DIUNDUR') ? 'rgb(255, 250, 0)' : (($item->status === 'MENUNGGU..') ? 'rgb(88, 88, 86)' : (($item->status === 'DITERIMA' || $item->status === 'SELESAI') ? 'rgb(17, 255, 0)' : 'gray')) }};">
                          {{$item->status}}
                        </span></td>
                      </tr> 
                      <tr>
                        <td><label for="">Nama Siswa</label></td>
                        <td><label>: {{$item->siswa->namasiswa}}</label></td>
                        
                      </tr>
                      <br>
                      <tr>
                        <td><label for="">Kelas</label></td>
                        <td><label type="" id="">: {{$item->siswa->kelas->kelas}}</label></td>
                      </tr>
                      <br>
                      <tr>
                        <td><label for="">Nama Wali Kelas </label></td>
                        <td><label type="" id="">: {{$item->wali_kelas->namagurukelas}}</label></td>
                      </tr>
                      <br>
                      <tr>
                        <td><label for="">Bimbingan</label></td>
                        <td><label type="" id="">: {{$item->layanan_bk->jenis_layanan}}</label></td>
                      </tr>
                      <br>
                      <tr>
                        <td><label for="">Hasil Konseling</label></td>
                        <td><label type="" id="">: {{$item->hasil_konseling}}</label></td>
                      </tr>
                      <br>
                      <tr>
                        <td><label for="">Waktu</label></td>
                        <td><label type="" id="">: {{$item->waktu}}</label></td>
                      </tr>
                      <br>
                      
                    </table>
                  </li>
                @endforeach
                </ul>
              </div> 
            </div>
        </div>
      </div>

      <script>
        function tampilkanForm() {
          document.getElementById("form-jadwal").style.display = "block";
          document.getElementById("list-jadwal").style.display = "none";
          document.getElementById("tambah-jadwal").style.display = "none";
        }
        function kembali() {
          document.getElementById("form-jadwal").style.display = "none";
          document.getElementById("list-jadwal").style.display = "block";
          document.getElementById("tambah-jadwal").style.display = "block";
        }
      </script>
@endsection