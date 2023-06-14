@extends('layouts.walas')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0 d-flex align-items-center">
            <h6 class="flex-grow-1">Form Peta Kerawanan</h6>
          </div>
          <div class="card-body px-4 pt-2 pb-2">
            <form action="/insertkerawananguru" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="siswa" class="form-label">Nama Siswa</label>
                  <select name="siswa_id" id="siswa_id" class="form-control" required>
                    <option  selected>Pilih Nama Siswa</option>
                    @foreach ($siswa as $datasiswa)
                      <option value="{{$datasiswa->id}}">{{$datasiswa->namasiswa}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="petakerawanan" class="form-label">Peta Kerawanan</label>
                  <select name="petakerawanan_id" id="petakerawanan_id" class="form-control" required>
                    <option  >Peta Kerawanan</option>
                    @foreach ($jenispetakerawanan as $peta)
                      <option value="{{$peta->id}}">{{$peta->jenispetakerawanan}}</option>
                    @endforeach
                  </select>
                </div>
                <button type="submit" class="btn" style="background-color: #4BBBFA; color: white">Tambah Data Peta Kerawanan</button>
            </form>      
          </div>
        </div>
      </div>
    </div>
  </div>         
@endsection