@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Header Card -->
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">{{ __('Login') }}</h3>
                </div>

                <!-- Body Card -->
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-primary">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold text-primary">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Login Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning btn-lg text-white fw-bold">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Footer Card -->
                <div class="card-footer text-center bg-light py-3">
                    <small class="text-muted">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-decoration-none text-primary fw-bold">Register here</a>
                        or 
                        <a href="{{ route('guest.login') }}" class="text-decoration-none text-primary fw-bold">Login as Guest</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
