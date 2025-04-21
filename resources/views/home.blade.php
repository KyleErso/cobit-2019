@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <!-- Main Card -->
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

          <!-- Toolbar untuk memilih Tools -->
          <div class="mt-4">
            <h5 class="fw-bold text-primary text-center mb-4">Pilih Tools</h5>
            <div class="scrollspy-example-horizontal" data-bs-spy="scroll" data-bs-target="#navbar-tools" data-bs-offset="0" tabindex="0" style="overflow-x: auto; white-space: nowrap;">
              <!-- Tombol COBIT -->
              <div class="d-inline-block mx-3" style="width: 200px;">
                <a href="{{ route('cobit.home') }}" class="btn btn-outline-primary btn-lg px-4 py-2 fw-bold shadow-sm hover-scale w-100" style="background-color: white;">
                  <img src="https://api.wakool.id/images/thumb900/2021041503045520200515230523COBIT2019_1623730934.jpg" alt="COBIT2019 Logo" class="img-fluid border" style="background-color: white;">
                </a>
              </div>
              <!-- Tombol ISO Tools -->
              <div class="d-inline-block mx-3" style="width: 200px;">
                <a href="#" onclick="alert('Coming Soon'); return false;" class="btn btn-outline-primary btn-lg px-4 py-2 fw-bold shadow-sm hover-scale w-100" style="background-color: white;">
                  <img src="https://www.china-gauges.com/Uploads/image/20230402/20230402085507_16632.png" alt="ISO Tools Logo" class="img-fluid">
                </a>
              </div>
                <!-- Tombol ISO Tools -->
              <div class="d-inline-block mx-3" style="width: 200px;">
                <a href="#" onclick="alert('Coming Soon'); return false;" class="btn btn-outline-primary btn-lg px-4 py-2 fw-bold shadow-sm hover-scale w-100" style="background-color: white;">
                  <img src="https://wqa.co.id/wp-content/uploads/2018/11/sertifikasi-iso-27001.gif" alt="ISO Tools Logo" class="img-fluid">
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer Card -->
        <div class="card-footer text-center bg-light py-3 rounded-bottom">
          <small class="text-muted">
            Need help? 
            <a href="https://wa.me/6287779511667?text=Halo%20saya%20ingin%20bertanya%20tentang%20COBIT2019" target="_blank" class="text-decoration-none text-primary fw-bold">
              Contact Support
            </a>
          </small>
        </div>
      </div>
    </div>

    <!-- Calendar Card -->
    <div class="col-md-4">
      <div class="card shadow-lg border-0 rounded-lg h-100">
        <!-- Header Card -->
        <div class="card-header bg-primary text-white text-center py-3 rounded-top">
          <h5 class="mb-0">{{ __('Kalender') }}</h5>
        </div>

        <!-- Body Card -->
        <div class="card-body p-4">
          <div class="text-center mb-3">
            <h5 class="mb-0" id="current-time">--:--:--</h5>
            <p class="mb-0" id="current-date">-- / -- / ----</p>
            <p class="mb-0" id="current-day">---</p>
          </div>
          <div id="calendar" class="bg-white p-2 rounded shadow"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include FullCalendar CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/id.min.js"></script>

<!-- Initialize FullCalendar and Current Time -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Update Current Time, Date, and Day
    function updateTime() {
      const now = new Date();
      const timeString = now.toLocaleTimeString('id-ID');
      const dateString = now.toLocaleDateString('id-ID');
      const dayString = now.toLocaleDateString('id-ID', { weekday: 'long' });
      document.getElementById('current-time').textContent = timeString;
      document.getElementById('current-date').textContent = dateString;
      document.getElementById('current-day').textContent = dayString;
    }
    setInterval(updateTime, 1000);
    updateTime();

    // Initialize FullCalendar
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'id',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: ''
      },
    });
    calendar.render();
  });
</script>
@endsection
