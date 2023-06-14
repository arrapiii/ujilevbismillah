@extends('layouts.walas')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          
         
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid ">
        <div class="col-md-14 mt-4">
            <div class="card" id="list-jadwal">
              <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center" id="daftar">
                <h4 class="mb-0">Daftar Jadwal Konseling</h4>
              </div>
              <div class="card-body pt-4 p-3">
                <ul class="list-group" id="list-jadwal">
                  @foreach ($jadwalbk as $item)
                  <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <span class="mb-2 text-xs">
                        Status:
                        <span class="p-1 rounded" style="display: inline-block; width: max-content; margin-top: 30px; font-weight: bold; color: white; background-color: {{ ($item->status === 'DIUNDUR') ? 'rgb(255, 250, 0)' : (($item->status === 'MENUNGGU..') ? 'rgb(88, 88, 86)' : (($item->status === 'DITERIMA' || $item->status === 'SELESAI') ? 'rgb(17, 255, 0)' : 'gray')) }};">
                          {{$item->status}}
                        </span>
                      </span>
                      <span class="mb-2 text-xs">Nama Siswa: <span class="text-dark font-weight-bold ms-sm-2">{{$item->siswa->namasiswa}}</span></span>
                      <span class="mb-2 text-xs">Kelas: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->siswa->kelas->kelas}}</span></span>
                      <span class="mb-2 text-xs">Nama Guru Pembimbing: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->guru->namaguru}}</span></span>
                      <span class="mb-2 text-xs">Bimbingan: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->layanan_bk->jenis_layanan}}</span></span>
                      <span class="mb-2 text-xs">Tempat: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->tempat}}</span></span>
                      <span class="mb-2 text-xs">Waktu: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->waktu}}</span></span>
                    </div>
                    <div class="ms-auto text-center" style="display: flex; flex-direction: column; justify-content: center;">
                      @if (($item->status === 'DITERIMA' || $item->status === 'DIUNDUR') && $item->layanan_bk->jenis_layanan === 'Bimbingan Belajar')
                        <a class="btn btn-link text-dark px-3 mb-2" onclick="showFinishForm({{ $item->id }})"> <i class="fas fa-check-circle me-2" aria-hidden="true"></i>Input Hasil
                            Bimbingan</a>
                      @endif
                    </div>
                  </li>
                  <div id="finish-form-{{ $item->id }}" style="display: none;">
                    <form action="/imputhasilbelajar/{{$item->id}}" method="POST" class="d-inline" style="vertical-align: middle;">
                      @csrf
                      <div class="form-group" style="display: flex; align-items: center;">
                        <label style="margin-right: 10px;">Hasil Konseling:</label>
                        <textarea placeholder="Masukan hasil bimbingan belajar" name="hasil_konseling" id="hasil_konseling-{{ $item->id }}" class="form-control" style="margin-right: 10px;"></textarea>
                        <input type="submit" value="Selesai" class="btn btn-primary" style="margin-bottom: 0px;margin-right: 10px;">
                        <input type="button" value="back" class="btn btn-primary" onclick="hideFinishForm({{ $item->id }})" style="margin-bottom: 0px">
                      </div>
                    </form>
                  </div>
                  @endforeach
                </ul>
              </div> 
            </div>
        </div>
      </div>


      <script>
        // {{-- digunakan untuk mengambil value dan masukannya ke dalam form (SELESAI)--}}
        function showFinishForm(itemId) {
          // Menampilkan formulir selesai yang sesuai dengan item yang dipilih
          var formId = 'finish-form-' + itemId;
          var formElement = document.getElementById(formId);
          formElement.style.display = 'block';
        }

        // {{}}
        function hideFinishForm(itemId) {
          var formId = 'finish-form-' + itemId;
          var formElement = document.getElementById(formId);
          formElement.style.display = 'none';
        }
      </script>
@endsection