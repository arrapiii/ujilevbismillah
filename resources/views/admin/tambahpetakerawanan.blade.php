
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
                    <form action="/insertpetakerawanan" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="row mb-3">
                          <div class="col-md-6">
                            <label for="nama" class="form-label">Jenis Kerawanan</label>
                            <input type="text" class="form-control" required name="jenispetakerawanan" id="jenispetakerawanan">
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