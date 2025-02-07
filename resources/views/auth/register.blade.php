@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Header Card -->
                <div class="card-header bg-primary text-white text-center py-4 rounded-top">
                    <h3 class="mb-0">{{ __('Register') }}</h3>
                </div>

                <!-- Body Card with Scrollspy -->
                <div class="card-body p-5" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" tabindex="0" style="max-height: 400px; overflow-y: auto;">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name Field -->
                        <div id="name-section" class="mb-4">
                            <label for="name" class="form-label fw-bold text-primary">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div id="email-section" class="mb-4">
                            <label for="email" class="form-label fw-bold text-primary">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div id="password-section" class="mb-4">
                            <label for="password" class="form-label fw-bold text-primary">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-bold text-primary">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                        </div>

                        <!-- Jabatan Field -->
                        <div id="jabatan-section" class="mb-4">
                            <label for="jabatan" class="form-label fw-bold text-primary">{{ __('Jabatan') }}</label>
                            <input id="jabatan" type="text" class="form-control form-control-lg @error('jabatan') is-invalid @enderror" name="jabatan" required placeholder="Enter your position">
                            @error('jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>

                <!-- Register Button Outside Scroll -->
                <div class="p-4">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg text-white fw-bold">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="card-footer text-center bg-light py-3 rounded-bottom">
                    <small class="text-muted">Already have an account? 
                        <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-bold">Login here</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection