@extends('layouts.guru')

@section('content')
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
              
              
            </div>
          </nav>
          <!-- End Navbar -->
          <div class="container-fluid py-4">
            <div class="row" >
              <div class="col-12" >
                <div class="card mb-4" style="height: 500px;">
                  <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div id="murid-container" class="px-4">
                            <div class="card-header pb-0">
                                <h3>Data Murid Kelas {{ $kelasguru->kelas }}</h3>
                            </div>
                            <table class="table mx-auto">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Murid</th>
                                        <th>email</th>
                                        <th>jenis kelamin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $index => $dataMurid)
                                        <tr>
                                          <td style="padding-left: 23px;">{{ $index + 1 }}</td>
                                          <td style="padding-left: 23px;">{{ $dataMurid->namasiswa }}</td>
                                          <td style="padding-left: 23px;">{{ $dataMurid->user->email }}</td>
                                          <td style="padding-left: 23px;">{{ $dataMurid->jeniskelamin }}</td>
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
          </div>
@endsection