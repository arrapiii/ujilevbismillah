@extends('layouts.admin')

@section('content')
        <!-- Navbar -->
        @if (Auth::check())
                        <span class="d-sm-inline d-none">
                            Selamat datang, {{ Auth::user()->name }}
                        </span>
                    @endif
        <!-- End Navbar -->
          <!-- isi end -->
@endsection