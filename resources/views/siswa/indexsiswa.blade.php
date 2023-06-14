@extends('layouts.admin')

@section('content')
    <!-- Navbar -->
    @if (Auth::check())
    <span class="d-sm-inline d-none">
        
    </span>
@endif
      <!-- End Navbar -->
      <section class="section profile">
        <div class="card-body">
          <h4 class="card-title">Data Siswa</h4>
          <a href="/tambahsiswa"><button type="button" class="btn btn-success" style="margin-left: 80%;">Tambah Data<ion-icon name="add-circle" style="font-size: 25px; margin-bottom: -6px; margin-left: 2px;"></ion-icon></button></a>
          <a href="/exportexcel"><button type="button" class="btn btn-success" style="margin-left: 80%;">exportexcel<ion-icon name="add-circle" style="font-size: 25px; margin-bottom: -6px; margin-left: 2px;"></ion-icon></button></a>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">Foto</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Walikelas</th>
                <th scope="col">Kelas</th>
                <th scope="col">Guru BK</th>
                <th scope="col" style="padding-left: 40px">Action</th>
                <!-- <th scope="col">NO TELEPON</th> -->
                {{-- <th scope="col">STATUS</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $siswa)
              <tr>
                <?php 
                  
                ?>
                <th scope="row">1</th>
                <td>
                <img src="{{asset('fotosiswa/'.$siswa->foto)}}" class="avatar avatar-sm me-3" alt="user1" style="width: 50px" height="50px">

                </td>
                <td>{{$siswa->namasiswa}}</td>
                <td>{{$siswa->user->email}}</td>
                <td>{{$siswa->kelas->walikelas->namagurukelas}}</td>
                <td>{{$siswa->kelas->kelas}}</td>
                <td>{{$siswa->kelas->guru->namaguru}}</td>
                <td>
                  <a href="/tampilkandatasiswa/{{$siswa->id}}"><button type="button" class="btn btn-warning" style="color: white;"><ion-icon name="create">
                  </ion-icon></button></a>
                  <a href="/deletedatasiswa/{{$siswa->id}}"><button type="button" class="btn btn-danger"><ion-icon name="trash"></ion-icon></button></a></td>
                </td>
                <!-- <td>08829460183</td> -->
                <td>
                  
                </tr>
                @endforeach
             
            </tbody>
          </table>
  
        </div>
      </section>
@endsection