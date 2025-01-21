@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Berhasil Login!') }}</div>

                <div class="card-body">
                    <p>Nama: {{ $user->name }}</p>
                    <p>Jabatan: {{ $user->jabatan ?? 'Jabatan tidak tersedia' }}</p> <!-- Ubah role menjadi jabatan -->

                    <div class="mt-3">
                        <ul class="navbar-nav ms-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @endguest
                        </ul>
                    </div>

                    <!-- Toolbar untuk memilih DF 1 - 10 -->
                    <div class="mt-4 text-center">
                        <h5>Pilih Design Factor</h5>
                        <a href="{{ route('df1.form', ['id' => 1]) }}" class="btn btn-primary mx-1">DF 1</a>
                        <a href="{{ route('df2.form', ['id' => 2]) }}" class="btn btn-primary mx-1">DF 2</a>
                        <a href="{{ route('df3.form', ['id' => 3]) }}" class="btn btn-primary mx-1">DF 3</a>
                        <a href="{{ route('df4.form', ['id' => 4]) }}" class="btn btn-primary mx-1">DF 4</a>
                        <a href="{{ route('df5.form', ['id' => 5]) }}" class="btn btn-primary mx-1">DF 5</a>
                        <a href="{{ route('df6.form', ['id' => 6]) }}" class="btn btn-primary mx-1">DF 6</a>
                        <a href="{{ route('df7.form', ['id' => 7]) }}" class="btn btn-primary mx-1">DF 7</a>
                        <a href="{{ route('df8.form', ['id' => 8]) }}" class="btn btn-primary mx-1">DF 8</a>
                        <a href="{{ route('df9.form', ['id' => 9]) }}" class="btn btn-primary mx-1">DF 9</a>
                        <a href="{{ route('df10.form', ['id' => 10]) }}" class="btn btn-primary mx-1">DF 10</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection