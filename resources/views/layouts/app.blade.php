<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>COBIT 2019</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('images/cobit.png') }}" type="image/png">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body class="{{ Route::is('login', 'register') ? 'login' : '' }}">
<div id="app">
  <!-- Navbar Utama -->
  <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}" alt="COBIT Logo" style="height: 40px;">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">
          <!-- Tambahkan link tambahan di sini jika diperlukan -->
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
          <!-- Authentication Links -->
          @guest
            @if (Route::has('login'))
              <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
            @endif
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
          @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                <strong>Selamat Datang 🤗, {{ Auth::user()->name }}</strong>
              </a>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- Offcanvas Sidebar (hanya muncul saat login) -->
  @auth
    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="sidebarOffcanvas"
      aria-labelledby="sidebarOffcanvasLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Sidebar Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-tasks me-2"></i> Assessment
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-chart-bar me-2"></i> Assessment Result
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-user-circle me-2"></i> Profile
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>
  @endauth
</div>


    @auth
<div class="container-fluid mt-5 pt-4 d-flex justify-content-center">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ url('/') }}">Home</a>
      </li>
      @for ($i = 1; $i <= 10; $i++)
        @if (Route::currentRouteName() == 'df' . $i . '.form')
          <li class="breadcrumb-item active" aria-current="page">DF {{ $i }}</li>
        @else
          <li class="breadcrumb-item">
            <a href="{{ route('df' . $i . '.form', ['id' => $i]) }}">DF {{ $i }}</a>
          </li>
        @endif
      @endfor
    </ol>
  </nav>
</div>
@endauth


    <!-- Main Content -->
<div class="container-fluid mt-3">
  <div class="row">
    <main class="mx-auto">
      <div>
        @yield('content')
      </div>
    </main>
  </div>
</div>


  <!-- Footer -->
  <footer class="container-fluid text-center py-3 mt-4">
    <p class="mb-1">By: Evan Kristian Pratama</p>
    <p class="mb-0">
      <a href="https://www.linkedin.com/in/evan-pratama-196119271/" target="_blank">LinkedIn</a>
    </p>
    <p class="mb-0">Version: 0.0.0</p>
  </footer>
</body>

</html>
