@extends('layouts.admin')

@section('content')
<section class="section profile">
  <div class="card-body">
    <h4 class="card-title">Data Kerawanan</h4>
    <a href="/tambahpelanggaran"><button type="button" class="btn btn-success" style="margin-left: 80%;">Tambah Data<ion-icon name="add-circle" style="font-size: 25px; margin-bottom: -6px; margin-left: 2px;"></ion-icon></button></a>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">NO</th>
          <th scope="col">Jenis Kerawanan</th>
          <th scope="col" style="padding-left: 40px">Action</th>
          <!-- <th scope="col">NO TELEPON</th> -->
          {{-- <th scope="col">STATUS</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $rawan)
        <tr>
          <?php 
            
          ?>
          <th scope="row">1</th>

          <td>{{$rawan->jenispetakerawanan}}</td>
          <td>
            <a href="/deletepetakerawanan/{{$rawan->id}}"><button type="button" class="btn btn-danger"><ion-icon name="trash"></ion-icon></button></a></td>
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