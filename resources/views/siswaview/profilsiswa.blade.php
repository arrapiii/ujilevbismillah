@extends('layouts.siswa')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
             
              
            </div>
          </nav>
          <!-- End Navbar -->
          <!-- isi start -->
          <div class="container-fluid py-4">
            <div class="row" >
              <div class="col-8" >
                <div class="card mb-4" style="height: auto;">
                  {{-- ////////// tampilan profil start ////////// --}}
                  <div class="card-body" id="profile-info">
                    <div class="profile-header">
                      <div class="profile-info">
                        <h4 class="card-title" style="font-weight: bold;">Profil Pengguna</h4>
                      </div>
                    </div>
                    <div class="card-text-row">
                        <div class="d-flex mb-1">
                          <h6 class="" style="width: 30%;">Nama</h6>
                          <h6 class="" style="width: 2%;">:</h6>
                          <p>{{ $user->siswa->namasiswa }}</p>
                        </div>
                        <div class="d-flex mb-1">
                          <h6 style="width: 30%;">email</h6>
                          <h6 class="" style="width: 2%;">:</h6>
                          <p>{{ $user->email }}</p>
                        </div>
                        <div class="d-flex mb-1">
                          <h6 style="width: 30%;">Kelas</h6>
                          <h6 class="" style="width: 2%;">:</h6>
                          <p>{{ $user->siswa->kelas->kelas }}</p>
                        </div>
                      <div class="d-flex mb-1">
                        <h6 style="width: 30%;">Jenis Kelamin</h6>
                        <h6 class="" style="width: 2%;">:</h6>
                        <p>{{ $user->siswa->jeniskelamin }}</p>
                      </div>
                      <div class="d-flex mb-1">
                        <h6 style="width: 30%;">Tempat & Tanggal Lahir</h6>
                        <h6  style="width: 2%;">:</h6>
                        <p>{{ $user->siswa->tempatlahir }}, {{ $user->siswa->tanggallahir }}</p>
                      </div>
                    </div>
                    <button class="btn" style="background-color: #4BBBFA; color: white; padding: 10px 37px;" onclick="editProfile()">Edit</button>
                  </div>
                  {{-- ////////// tampilan profil End ////////// --}}
                  <div id="edit-form" style="display: none;" class="pt-3">
                    <form class="mx-4" action="/updateprofilsiswa/{{$user->siswa->id}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-nama" class="form-label">Nama</label>
                            <input type="text" name="namasiswa" class="form-control" id="edit-nama" value="{{ $user->siswa->namasiswa }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-nip" class="form-label">email</label>
                            <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="edit-password" placeholder="*DI ISI JIKA INGIN GANTI PASSWORD*">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempatlahir" id="tempatlahir" value="{{$user->siswa->tempatlahir}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="tanggallahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggallahir" id="tanggallahir" name="tanggallahir" value="{{$user->siswa->tanggallahir}}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jeniskelamin" id="jeniskelamin">
                              <option selected>{{$user->siswa->jeniskelamin}}</option>
                              <option value="laki-laki">Laki-laki</option>
                              <option value="perempuan">Perempuan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" class="btn" style="background-color: #4BBBFA; color: white">Simpan</button>
                          <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Batal</button>
                        </div>
                      </div>
                    </form>   
                  </div>
                </div>
              </div>
              <div class="col-4" >
                <div class="card" style="height: 410px;">
                <div class="profile-picture pt-1 p-5 pr-5 d-block align-items-center text-center" style="margin: 0 auto;  ">
                  <div class="foto-container mt-4" style="margin: 0 auto; width: 200px; height: 200px;">
                    <img src="{{ asset('fotosiswa/'.$user->siswa->foto) }}" alt="Foto Pengguna" id="foto">
                  </div>
                  <h5 class="mt-2" style="font-weight: bold; font-size: 18px;">{{ $user->siswa->namasiswa }}</p>
                  <p class="" style="font-size: 13px; margin-top: -10px;">Siswa Smk Taruna Bhakti</p>
                </div>
                </div>
              </div>
            </div>
          </div>

          <style>
            .profile-header {
              display: flex;
              align-items: center;
              margin-bottom: 20px;
            }
            
            .profile-picture {
              margin-right: 20px;
            }
            
            .foto-container {
              width: 100px;
              height: 100px;
              overflow: hidden;
              border-radius: 50%;
            }
            
            .foto-container img {
              width: 100%;
              height: 100%;
              object-fit: cover;
            }
            
            .card-text-container {
              display: grid;
              grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
              grid-gap: 20px;
            }
            
            .card-text {
              background-color: #f9f9f9;
              padding: 10px;
              border-radius: 5px;
            }
            
            .card-text h6 {
              font-weight: bold;
              margin-bottom: 5px;
            }
            
            .btn {
              margin-top: 20px;
            }
          </style>
          <script>
            function editProfile() {
              document.getElementById("profile-info").style.display = "none";
              document.getElementById("edit-form").style.display = "block";
            }
          
            function cancelEdit() {
              document.getElementById("profile-info").style.display = "block";
              document.getElementById("edit-form").style.display = "none";
            }
          </script>
          
@endsection