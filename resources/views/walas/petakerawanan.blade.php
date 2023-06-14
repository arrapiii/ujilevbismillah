@extends('layouts.walas')

@section('content')
        <!-- Navbar -->
@if (Auth::check())
  <span class="d-sm-inline d-none">
                                
  </span>
@endif
<div class="container-fluid py-4">
    <div class="row" >
      <div class="col-12" >
        <div class="card mb-4" style="height: 500px;">
            <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center" id="daftar">
                <h6 class="mb-0">Daftar Peta Kerawanan</h6>
                <a class="btn btn-primary" id="tambah-jadwal" href="/tambahpetakerawanan">Tambah Peta Kerawanan</a>
              </div>
          <div class="card-header pb-0">
            <h6></h6>
          </div>
        
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <div class="container">
                <div class="row d-flex flex-wrap">
                  @foreach ($siswa as $siswa)
                  <div class="">
                    <a href="/jeniskerawanan/{{$siswa->id}}">
                      <div class="card border shadow-sm">
                        <div class="card-body">
                          <h5 class="mt-4">{{ $siswa->namasiswa}}</h5>
                          <h5 class="">{{ $siswa->user->email }}</h5>
                          <h5 class="">{{ $siswa->kelas->kelas }}</h5>
                          <h5 class="">{{ $siswa->kelas->jenispetakerawanan }}</h5>
                        </div>
                      </div>
                    </a>
                  </div>
                  @endforeach
                </div>
              </div>                                     
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
    // Menangkap klik pada card
    $('.card').on('click', function() {
      // Mendapatkan ID kelas dari atribut data
      var kelasId = $(this).data('kelas-id');
  
      // Mengirim permintaan AJAX untuk memuat data murid
      $.ajax({
        url: '/siswa/' + kelasId, // Ubah URL sesuai dengan rute yang sesuai
        method: 'GET',
        success: function(response) {
          // Manipulasi DOM untuk menampilkan data murid
          // Misalnya, tampilkan data murid dalam elemen dengan ID tertentu
          $('#murid-container').html(response);
        },
        error: function(xhr) {
          // Penanganan kesalahan
        }
      });
    });
  </script>
@endsection
