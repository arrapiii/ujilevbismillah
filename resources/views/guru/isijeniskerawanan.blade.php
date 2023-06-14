@extends('layouts.admin')

@section('content')
        <!-- Navbar -->
@if (Auth::check())
  <span class="d-sm-inline d-none">
                                
  </span>
@endif <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0 d-flex align-items-center">
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PETA KERAWANAN</th>
                  </tr>
                </thead>
                @php
                    $no = 1;
                @endphp
                <tbody>
                @foreach ($jenisKerawanan as $jenis)
                    <tr>
                        <td scope="row">{{ $no++ }}</th>
                        <td>{{ $jenis->petakerawanan->jenispetakerawanan }}</td>
                        <td class="align-middle">
                            <a href="/deletekerawanan/{{ $jenis->id }}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user">
                              <i class="fas fa-trash-alt fa-lg"></i>
                            </a>
                          </td>
                    </tr>
                    
                @endforeach
                </tbody>
              </table>                      
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
