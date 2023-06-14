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
                    <h6 class="flex-grow-1">Form Kelas</h6>
                  </div>
                  <div class="card-body px-4 pt-2 pb-2">
                    <form action="/insertdatakelas" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="kelas" class="form-label">Kelas</label>
                          <input type="text" class="form-control" required id="kelas" name="kelas" required>
                        </div>
                        <div class="mb-3">
                          <label for="guru_id" class="form-label">Guru BK</label>
                          <select name="guru_id" id="guru_id" class="form-control" required>
                            <option disabled selected>Pilih Guru BK</option>
                            @foreach ($dataguru as $guru)
                              <option value="{{$guru->id}}">{{$guru->namaguru}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="walikelas_id" class="form-label">Wali Kelas</label>
                          <select name="walikelas_id" id="walikelas_id" class="form-control" required>
                            <option disabled selected>Pilih Wali Kelas</option>
                            @foreach ($datawalikelas as $walikelas)
                              <option value="{{$walikelas->id}}">{{$walikelas->namagurukelas}}</option>
                            @endforeach
                          </select>
                        </div>
                        <button type="submit" class="btn" style="background-color: #515CED; color: white">Tambah Data Kelas dan Guru</button>
                    </form>      
                  </div>
                </div>
              </div>
            </div>
          </div>            
@endsection