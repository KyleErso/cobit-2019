@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <!-- Main Card -->
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-lg">
        <!-- Header Card -->
        <div class="card-header bg-primary text-white text-center py-4 rounded-top">
          <h3 class="mb-0">{{ __('Cobit 2019 Tools') }}</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body p-5">
          <!-- User Information -->
          <div class="text-center mb-4">
            <h4 class="fw-bold text-primary">{{ Auth::user()->name }}</h4>
            <p class="text-muted">Jabatan: {{ Auth::user()->jabatan ?? 'Jabatan tidak tersedia' }}</p>
          </div>

          <!-- Join Form -->
          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          <form action="{{ route('assessment.join.store') }}" method="POST">
            @csrf
            <!-- Input Kode Rancangan -->
            <div class="mb-3">
              <label for="kode_assessment" class="form-label">Kode Rancangan</label>
              <input type="text"
                     name="kode_assessment"
                     id="kode_assessment"
                     class="form-control @error('kode_assessment') is-invalid @enderror"
                     value="{{ old('kode_assessment') }}"
                     placeholder="Masukkan kode rancangan"
                     required>
              @error('kode_assessment')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-warning btn-lg fw-bold shadow-sm">
                Rancangan Baru
              </button>
            </div>
          </form>
        </div>

        <!-- Footer Card -->
        <div class="card-footer text-center bg-light py-3 rounded-bottom">
          <small class="text-muted">
            Need help? 
            <a href="https://wa.me/6287779511667?text=Halo%20saya%20ingin%20bertanya%20tentang%20COBIT2019" 
               target="_blank" 
               class="text-decoration-none text-primary fw-bold">
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
    function updateTime() {
      const now = new Date();
      document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID');
      document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID');
      document.getElementById('current-day').textContent = now.toLocaleDateString('id-ID', { weekday: 'long' });
    }
    setInterval(updateTime, 1000);
    updateTime();

    const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
      initialView: 'dayGridMonth',
      locale: 'id',
      headerToolbar: { left: 'prev,next today', center: 'title', right: '' },
    });
    calendar.render();
  });
</script>
@endsection
