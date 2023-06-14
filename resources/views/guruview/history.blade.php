@extends('layouts.guru')

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
                <h4 class="mb-0">Daftar Archives Jadwal</h4>
              </div>
              <div class="card-body pt-4 p-3">
                <ul class="list-group" id="list-jadwal">
                  @foreach ($jadwalbk as $item)
                  <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      
                  
                    </div>
                    <table border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td><label for="">Status </label></td>
                        <td>: <span class="p-1 rounded" style="display: inline-block; width: max-content;font-weight: bold; color: white; background-color: {{ ($item->status === 'DIUNDUR') ? 'rgb(255, 250, 0)' : (($item->status === 'MENUNGGU..') ? 'rgb(88, 88, 86)' : (($item->status === 'DITERIMA' || $item->status === 'SELESAI') ? 'rgb(17, 255, 0)' : 'gray')) }};">
                          {{$item->status}}
                        </span></td>
                      </tr> 
                      <tr>
                        <td><label for="">Nama Siswa</label></td>
                        <td><label>: {{$item->siswa->namasiswa}}</label></td>
                        
                      </tr>
                      <br>
                      <tr>
                        <td><label for="">Kelas</label></td>
                        <td><label type="" id="">: {{$item->siswa->kelas->kelas}}</label></td>
                      </tr>
                      <br>
                      <tr>
                        <td><label for="">Nama Wali Kelas </label></td>
                        <td><label type="" id="">: {{$item->wali_kelas->namagurukelas}}</label></td>
                      </tr>
                      <br>
                      <tr>
                        <td><label for="">Bimbingan</label></td>
                        <td><label type="" id="">: {{$item->layanan_bk->jenis_layanan}}</label></td>
                      </tr>
                      <br>
                      <tr>
                        <td><label for="">Hasil Konseling</label></td>
                        <td><label type="" id="">: {{$item->hasil_konseling}}</label></td>
                      </tr>
                      <br>
                      <tr>
                        <td><label for="">Waktu</label></td>
                        <td><label type="" id="">: {{$item->waktu}}</label></td>
                      </tr>
                      <br>
                      
                    </table>
                  
                    <div class="ms-auto text-center" style="display: flex; flex-direction: column; justify-content: center;">
                      @if ($item->status === 'DITERIMA' || $item->status === 'DIUNDUR')
                        <a class="btn btn-link text-dark px-3 mb-2" onclick="showFinishForm({{ $item->id }})"> <i class="fas fa-check-circle me-2" aria-hidden="true"></i>Selesai</a>
                      @endif
                      @if ($item->status === 'MENUNGGU..')
                        <a class="btn btn-link text-dark px-3 mb-2" onclick="formAcc({{ $item->id }}, '{{ $item->tempat }}')"> <i class="fas fa-check text-success me-2" aria-hidden="true"></i>Terima</a>
                        <a class="btn btn-link text-dark px-3 mb-2" onclick="formundurjadwal({{$item->id}}, '{{$item->waktu}}'); return false;"><i class="fas fa-clock text-warning me-2" aria-hidden="true"></i>Diundur</a>
                      @endif
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div> 
            </div>
        </div>
      </div>
@endsection