@extends('layouts.app')

@section('content')
<div class="card my-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="mb-0">COBIT 2019 Tools</h3>
        <a href="{{ route('cobit.home') }}" class="btn btn-close btn-close-white" aria-label="Close"></a>
    </div>
    <div class="card-body">
        @php
            $user = Auth::user();
            if ($user && $user->role === 'Guest') {
                $assessmentId = 'guest';
                $instansi = 'guest';
            } else {
                $assessmentId = session('assessment_id');
                $instansi = session('instansi');
            }
            $userJabatan = $user->jabatan ?? 'Jabatan tidak tersedia';
        @endphp

        <table class="table table-bordered table-striped">
            <tr>
                <th style="width: 30%;">Assessment ID</th>
                <td>{{ $assessmentId }}</td>
            </tr>
            <tr>
                <th>Nama Instansi</th>
                <td>{{ $instansi }}</td>
            </tr>
            <tr>
                <th>Nama User</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Jabatan User</th>
                <td>{{ $userJabatan }}</td>
            </tr>
        </table>

        @yield('cobit-tools-content')
    </div>
</div>
@endsection
