@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center g-4">
    <!-- Main Card -->
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
        <!-- Header Card -->
        <div class="card-header bg-primary text-white text-center position-relative py-4">
          <h3 class="mb-0 fw-semibold">{{ __('Cobit 2019 Tools') }}</h3>
          <div class="position-absolute start-0 bottom-0 w-100">
          </div>
        </div>

        <!-- Body Card -->
        <div class="card-body p-4 p-xl-5">
          <!-- User Information -->
          <div class="text-center mb-4">
            <div class="avatar-frame mb-3">
              <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex justify-content-center align-items-center" 
                   style="width: 80px; height: 80px;">
                <i class="fas fa-user-gear fa-2x"></i>
              </div>
            </div>
            <h4 class="h3 fw-bold text-primary mb-1">{{ Auth::user()->name }}</h4>
            <div class="badge bg-primary bg-opacity-10 text-primary mt-2 px-3 py-2">
              <i class="fas fa-id-card-clip me-2"></i>
              {{ Auth::user()->jabatan ?? 'Jabatan tidak tersedia' }}
            </div>
          </div>

          <!-- Join Form -->
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <form action="{{ route('assessment.join.store') }}" method="POST">
            @csrf
            <div class="mb-4">
              <div class="input-group input-group-lg">
                <span class="input-group-text bg-primary bg-opacity-10 border-primary">
                  <i class="fas fa-key text-primary"></i>
                </span>
                <input type="text" 
                       name="kode_assessment"
                       id="kode_assessment"
                       class="form-control form-control-lg border-primary @error('kode_assessment') is-invalid @enderror"
                       placeholder="Masukkan kode rancangan"
                       value="{{ old('kode_assessment') }}"
                       required>
                @error('kode_assessment')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <button type="submit" class="btn btn-lg btn-warning w-100 fw-bold py-3 shadow-primary-lg">
              <i class="fas fa-magic-wand-sparkles me-2"></i>Buat Rancangan Baru
            </button>
          </form>
        </div>

        <!-- Footer Card -->
        <div class="card-footer text-center bg-opacity-5 py-3">
          <small class="text-muted d-block mb-1">Butuh bantuan? Hubungi kami melalui:</small>
          <a href="https://wa.me/6287779511667?text=Halo%20saya%20ingin%20bertanya%20tentang%20COBIT2019" 
             target="_blank" 
             class="btn btn-sm btn-success px-4 shadow-sm">
            <i class="fab fa-whatsapp me-2"></i>WhatsApp
          </a>
        </div>
      </div>
    </div>

    <!-- Calendar Card -->
    <div class="col-md-4">
      <div class="card shadow-lg border-0 rounded-3 h-100 overflow-hidden">
        <!-- Header Card -->
        <div class="card-header bg-primary text-white text-center py-3">
          <h5 class="mb-0 fw-semibold">{{ __('Kalender') }}</h5>
        </div>

        <!-- Body Card -->
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <div class="datetime-container bg-primary bg-opacity-10 p-3 rounded-3 border border-primary border-opacity-25">
              <div class="h3 mb-2 text-primary fw-bold" id="current-time"></div>
              <div class="text-primary mb-1" id="current-date"></div>
              <div class="text-uppercase text-primary fw-semibold" id="current-day"></div>
            </div>
          </div>
          <div id="calendar" class="border-primary border-opacity-25 rounded-3"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Styles -->
<style>
  .shadow-primary-lg {
    box-shadow: 0 0.5rem 1.5rem rgba(var(--bs-primary-rgb), 0.2) !important;
  }
  
  .input-group-text {
    transition: all 0.3s ease;
  }
  
  .input-group:focus-within .input-group-text {
    background-color: rgba(var(--bs-primary-rgb), 0.2) !important;
  }
  
  #calendar .fc-toolbar-title {
    font-size: 1.1rem;
  }
  
  #calendar .fc-button-primary {
    background-color: var(--bs-primary) !important;
    border-color: var(--bs-primary) !important;
  }

  #calendar .fc-view-harness {
    height: 300px !important;
    overflow-y: auto !important;
  }

  #calendar .fc-scroller {
    overflow-y: auto !important;
  }

  #calendar .fc-scroller::-webkit-scrollbar {
    width: 8px;
  }

  #calendar .fc-scroller::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
  }

  #calendar .fc-scroller::-webkit-scrollbar-thumb {
    background: var(--bs-primary);
    border-radius: 4px;
  }

  #calendar .fc-scroller::-webkit-scrollbar-thumb:hover {
    background: var(--bs-primary-dark);
  }

  #calendar .fc-col-header {
    position: sticky !important;
    top: 0;
    z-index: 1;
    background: white;
  }

  #calendar .fc-col-header-cell {
    background: var(--bs-primary) !important;
    color: white !important;
  }

  #calendar .fc-col-header-cell-cushion {
    color: white !important;
  }
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/id.min.js"></script>
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