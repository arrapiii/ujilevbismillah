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
                  <div class="card-header pb-0">
                    <h6 >Daftar kelas</h6>
                  </div>
                  <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                      <div class="container">
                        <div class="row d-flex flex-wrap mt-4">
                          @foreach ($kelas as $kelasguru)
                          <div class="col-md-4 mb-4">
                            <a href="/siswa/{{ $kelasguru->id }}">
                              <div class="card border shadow-sm">
                                <div class="card-body">
                                  <h5 class="card-title">{{ $kelasguru->kelas }}</h5>
                                  <p class="card-text">Wali Kelas: {{ $kelasguru->walikelas->namagurukelas }}</p>
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