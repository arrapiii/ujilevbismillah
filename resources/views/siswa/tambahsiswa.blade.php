@extends('layouts.admin')

@section('content')
        <!-- Navbar -->
        @if (Auth::check())
        <span class="d-sm-inline d-none">
            {{ Auth::user()->name }}
        </span>
    @endif
          <!-- End Navbar -->
          <div class="container-fluid py-4">
            <div class="row">
              <div class="col-12">
                <div class="card mb-4">
                  <div class="card-header pb-0 d-flex align-items-center">
                    <h6 class="flex-grow-1">Form Murid</h6>
                  </div>
                  <div class="card-body px-4 pt-2 pb-2">
                    <form action="/insertdatasiswa" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="row mb-3">
                          <div class="col-md-6">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" required name="namasiswa" id="namasiswa">
                          </div>
                          <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jeniskelamin" required id="jeniskelamin">
                              <option value="laki-laki">Laki-laki</option>
                              <option value="perempuan">Perempuan</option>
                            </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                              <label for="email" class="form-label">Email</label>
                              <input type="text" class="form-control" required name="email" id="email">
                            </div>
                            <div class="col-md-6">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" class="form-control" required name="password" id="password">
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-md-6">
                              <label for="tanggallahir" class="form-label">Tanggal Lahir</label>
                              <input type="date" class="form-control" required id="tanggallahir" name="tanggallahir">
                            </div>
                            <div class="col-md-6">
                              <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                              <input type="text" class="form-control" required name="tempatlahir" id="tempatlahir">
                            </div>
                          </div>
                        <div class="row mb-3">
                          <div class="col-md-6">
                            <label for="foto" class="form-label">Masukan Foto</label>
                            <input type="file" class="form-control" required name="foto" id="foto">
                          </div>
                          <div class="col-md-6">
                            <label for="guru_id" class="form-label">Kelas</label>
                            <select name="kelas_id"  required id="kelas_id" class="form-control" required>
                              <option disabled selected>Pilih Kelas</option>
                              @foreach ($data as $kelas)
                                <option value="{{$kelas->id}}">{{$kelas->kelas}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <button type="submit" class="btn" style="background-color: #515CED; color: white">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>            
@endsection