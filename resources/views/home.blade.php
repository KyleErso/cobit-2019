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

                    <!-- Toolbar untuk memilih Design Factor -->
                    <div class="mt-4">
                        <h5 class="fw-bold text-primary text-center mb-4">Pilih Design Factor</h5>
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
                    <small class="text-muted">
                        Need help? 
                        <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20bertanya%20tentang%20COBIT" 
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
        display: flex;
        align-items: stretch;
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

    /* FullCalendar Styling */
    #calendar {
        max-width: 100%;
        margin: 0 auto;
        font-size: 0.8rem; /* Reduce font size */
    }
    .fc-header-toolbar {
        margin-bottom: 0.5rem;
    }
    .fc-event {
        cursor: pointer;
        font-size: 0.8rem; /* Reduce font size */
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
            locale: 'id', // Set locale to Indonesian
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: '' // Remove unnecessary buttons
            },
        });
        calendar.render();
    });
</script>
@endsection