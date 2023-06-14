@extends('layouts.admin')

@section('content')
        <!-- Navbar -->
@if (Auth::check())
  <span class="d-sm-inline d-none">
                                
  </span>
@endif
<section class="section profile">
  <div class="card-body">
    <h4 class="card-title">Data Siswa</h4>
    <a href="/tambahdatawalikelas"><button type="button" class="btn btn-success" style="margin-left: 80%;">Tambah Data<ion-icon name="add-circle" style="font-size: 25px; margin-bottom: -6px; margin-left: 2px;"></ion-icon></button></a>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">NO</th>
          <th scope="col">Foto</th>
          <th scope="col">Email</th>
          <th scope="col">Nama</th>
          <th scope="col">Tanggal Lahir</th>
          <th scope="col">Jenis Kelamin</th>
          <th scope="col" style="padding-left: 40px">Action</th>
          <!-- <th scope="col">NO TELEPON</th> -->
          {{-- <th scope="col">STATUS</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $walikelas)
        <tr>
          <?php 
            
          ?>
          <th scope="row">1</th>
          <td>
          <img src="{{asset('fotowalikelas/'.$walikelas->foto)}}" class="avatar avatar-sm me-3" alt="user1" style="width: 50px" height="50px">

          </td>
          <td>{{$walikelas->namagurukelas}}</td>
          <td>{{$walikelas->user->email}}</td>
          <td>{{$walikelas->tanggallahir}}</td>
          <td>{{$walikelas->jeniskelamin}}</td>
          <td>
            <a href="/tampilkandatawalikelas/{{$walikelas->id}}"><button type="button" class="btn btn-warning" style="color: white;"><ion-icon name="create">
            </ion-icon></button></a>
            <a href="/deletedatawalikelas/{{$walikelas->id}}"><button type="button" class="btn btn-danger"><ion-icon name="trash"></ion-icon></button></a></td>
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
