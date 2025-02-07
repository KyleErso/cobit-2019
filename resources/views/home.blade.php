@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Header Card -->
                <div class="card-header bg-primary text-white text-center py-4 rounded-top">
                    <h3 class="mb-0">{{ __('Selamat Datang!') }}</h3>
                </div>

                <!-- Body Card -->
                <div class="card-body p-5">
                    <!-- User Information -->
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-primary">{{ $user->name }}</h4>
                        <p class="text-muted">Jabatan: {{ $user->jabatan ?? 'Jabatan tidak tersedia' }}</p>
                    </div>

                    <!-- Toolbar untuk memilih Design Factor -->
                    <div class="mt-4">
                        <h5 class="fw-bold text-primary text-center mb-4">Pilih Design Factor</h5>

                        <!-- Scrollable Content with Horizontal Scrollspy -->
                        <div class="scrollspy-example-horizontal" data-bs-spy="scroll" data-bs-target="#navbar-df" data-bs-offset="0" tabindex="0" style="overflow-x: auto; white-space: nowrap;">
                            @for ($i = 1; $i <= 10; $i++)
                                <div id="df{{ $i }}" class="d-inline-block mx-3" style="width: 200px;">
                                    <a href="{{ route('df' . $i . '.form', ['id' => $i]) }}" 
                                       class="btn btn-warning btn-lg px-4 py-2 fw-bold shadow-sm hover-scale w-100">
                                        DF {{ $i }}
                                    </a>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="card-footer text-center bg-light py-3 rounded-bottom">
                    <small class="text-muted">Need help? 
                        <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20bertanya%20tentang%20COBIT" 
                           target="_blank" 
                           class="text-decoration-none text-primary fw-bold">
                            Contact Support
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for Hover Effect -->
<style>
    /* Hover Effect for Buttons */
    .hover-scale {
        transition: transform 0.3s ease-in-out;
    }
    .hover-scale:hover {
        transform: scale(1.1);
    }

    /* Center Align the Card Vertically */
    .row.justify-content-center {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    /* Scrollspy Horizontal Styling */
    .scrollspy-example-horizontal {
        max-width: 100%;
        overflow-x: auto;
        padding: 10px 0;
    }
    .scrollspy-example-horizontal::-webkit-scrollbar {
        height: 8px;
    }
    .scrollspy-example-horizontal::-webkit-scrollbar-thumb {
        background-color: #e47929;
        border-radius: 4px;
    }
</style>
@endsection