@extends('layouts.admin')

@section('content')
        <!-- Navbar -->
         <!-- DataTales Example -->

      @if (Auth::check())
      <span class="d-sm-inline d-none">
          
      </span>
  @endif
  <section class="section profile">
    <div class="card-body">
      <h4 class="card-title">Data Guru</h4>
      <a href="/tambahdataguru"><button type="button" class="btn btn-success" style="margin-left: 80%;">Tambah Data<ion-icon name="add-circle" style="font-size: 25px; margin-bottom: -6px; margin-left: 2px;"></ion-icon></button></a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">NO</th>
            <th scope="col">Foto</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Tanggal Lahir</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Action</th>
            <!-- <th scope="col">NO TELEPON</th> -->
            {{-- <th scope="col">STATUS</th> --}}
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $guru)
          <tr>
            <?php 
              
            ?>
            <th scope="row">1</th>
            <td>
              <img src="{{asset('fotoguru/'.$guru->foto)}}" class="avatar avatar-sm me-3" alt="user1" style="width: 50px" height="50px">
            </td>
            <td>{{$guru->namaguru}}</td>
            <td>{{$guru->user->email}}</td>
            <td>{{$guru->tanggallahir}}</td>
            <td>{{$guru->jeniskelamin}}</td>
            <td>
              <a href="/tampilkandataguru/{{$guru->id}}"><button type="button" class="btn btn-warning" style="color: white;"><ion-icon name="create">
              </ion-icon></button></a>
              <a href="/deletedataguru/{{$guru->id}}"><button type="button" class="btn btn-danger"><ion-icon name="trash"></ion-icon></button></a></td>
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