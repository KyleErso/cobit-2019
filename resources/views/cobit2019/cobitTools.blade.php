@extends('layouts.app')

@section('content')
<div class="card my-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="mb-0">COBIT 2019 Tools</h3>
        <a href="{{ route('cobit.home') }}" class="btn btn-close btn-close-white" aria-label="Close"></a>
    </div>
    <div class="card-body">
        @yield('cobit-tools-content')
    </div>
</div>
@endsection
