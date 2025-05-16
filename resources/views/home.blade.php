@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center g-4">
    <!-- Main Card -->
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
        <!-- Header Card -->
        <div class="card-header bg-primary text-white text-center position-relative py-4">
          <h3 class="mb-0 fw-semibold">{{ __('Selamat Datang!') }}</h3>
        </div>

        <!-- Body Card -->
        <div class="card-body p-4 p-xl-5">
          <!-- User Information -->
          <div class="text-center mb-4">
            <div class="avatar-frame mb-3">
              <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center mx-auto" 
                   style="width: 80px; height: 80px;">
                <i class="fas fa-user fa-2x"></i>
              </div>
            </div>
            <h4 class="h3 fw-bold text-primary mb-2">{{ $user->name }}</h4>
            <div class="d-flex flex-column align-items-center">
              <div class="badge bg-secondary bg-opacity-10 text-secondary mt-2 px-3 py-2 fs-4 w-50 text-center">
                <i class="fas fa-building me-2"></i>
                {{ $user->organisasi ?? 'Organisasi tidak tersedia' }}
              </div>
              <div class="badge bg-primary bg-opacity-10 text-primary mt-2 px-3 py-2 fs-5 w-50 text-center">
                <i class="fas fa-id-card-clip me-2"></i>
                {{ $user->jabatan ?? 'Jabatan tidak tersedia' }}
              </div>
            </div>
          </div>

          <!-- Toolbar untuk memilih Tools -->
          <div class="mt-4">
            <h5 class="fw-bold text-primary text-center mb-4">Pilih Tools</h5>
            <div class="scrollspy-example-horizontal" data-bs-spy="scroll" data-bs-target="#navbar-tools" data-bs-offset="0" tabindex="0" style="overflow-x: auto; white-space: nowrap;">
              <!-- Tombol COBIT -->
              <div class="d-inline-block mx-3" style="width: 200px;">
                <a href="{{ route('cobit.home') }}" class="btn btn-outline-primary btn-lg px-4 py-2 fw-bold shadow-sm w-100">
                  <img src="https://api.wakool.id/images/thumb900/2021041503045520200515230523COBIT2019_1623730934.jpg" alt="COBIT2019 Logo" class="img-fluid border">
                </a>
              </div>
              <!-- Tombol ISO Tools -->
              <div class="d-inline-block mx-3" style="width: 200px;">
                <a href="#" onclick="alert('Coming Soon'); return false;" class="btn btn-outline-primary btn-lg px-4 py-2 fw-bold shadow-sm w-100">
                  <img src="https://www.china-gauges.com/Uploads/image/20230402/20230402085507_16632.png" alt="ISO Tools Logo" class="img-fluid">
                </a>
              </div>
              <!-- Tombol ISO Tools -->
              <div class="d-inline-block mx-3" style="width: 200px;">
                <a href="#" onclick="alert('Coming Soon'); return false;" class="btn btn-outline-primary btn-lg px-4 py-2 fw-bold shadow-sm w-100">
                  <img src="https://wqa.co.id/wp-content/uploads/2018/11/sertifikasi-iso-27001.gif" alt="ISO Tools Logo" class="img-fluid">
                </a>
              </div>
            </div>
          </div>
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

   /* Style tombol agar tetap putih saat hover */
   a.btn-outline-primary:hover {
        background-color: #fff !important;
        color: inherit !important;
        border-color: inherit !important;
    }
    /* Style lainnya... */
    .shadow-primary-lg {
      box-shadow: 0 0.5rem 1.5rem rgba(var(--bs-primary-rgb), 0.2) !important;
    }
    
  /* Shadow */
  .shadow-primary-lg {
    box-shadow: 0 0.5rem 1.5rem rgba(var(--bs-primary-rgb), 0.2) !important;
  }

  /* Calendar Container */
  #calendar {
    border: 1px solid rgba(var(--bs-primary-rgb), 0.2);
    border-radius: 0.5rem;
  }

  /* Calendar Header */
  #calendar .fc-toolbar {
    padding: 1rem;
  }

  #calendar .fc-toolbar-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--bs-primary);
  }
  
  #calendar .fc-button-primary {
    background-color: var(--bs-primary) !important;
    border-color: var(--bs-primary) !important;
    font-size: 0.9rem;
    padding: 0.4rem 0.8rem;
  }

  /* Calendar Body */
  #calendar .fc-view-harness {
    height: 300px !important;
    overflow-y: auto !important;
  }

  #calendar .fc-scroller {
    overflow-y: auto !important;
  }

  /* Scrollbar Styling */
  #calendar .fc-scroller::-webkit-scrollbar {
    width: 6px;
  }

  #calendar .fc-scroller::-webkit-scrollbar-track {
    background: #f8f9fa;
    border-radius: 3px;
  }

  #calendar .fc-scroller::-webkit-scrollbar-thumb {
    background: var(--bs-primary);
    border-radius: 3px;
  }

  /* Calendar Header Cells */
  #calendar .fc-col-header {
    position: sticky !important;
    top: 0;
    z-index: 1;
    background: white;
  }

  #calendar .fc-col-header-cell {
    background: var(--bs-primary) !important;
    color: white !important;
    padding: 0.5rem 0;
  }

  #calendar .fc-col-header-cell-cushion {
    color: white !important;
    text-decoration: none;
  }

  /* Calendar Days */
  #calendar .fc-daygrid-day {
    border: 1px solid rgba(var(--bs-primary-rgb), 0.1);
  }

  #calendar .fc-daygrid-day-number {
    padding: 0.5rem;
    color: var(--bs-primary);
  }

  #calendar .fc-day-today {
    background-color: rgba(var(--bs-primary-rgb), 0.05) !important;
  }
</style>

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
