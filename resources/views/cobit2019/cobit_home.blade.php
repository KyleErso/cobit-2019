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

                    <!-- Tombol Mulai Assessment -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('df1.form', ['id' => 1]) }}"
                               class="btn btn-warning btn-lg px-5 py-3 fw-bold shadow-sm">
                                Mulai Assessment
                            </a>
                        </div>
                    </div>
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
            const timeString = now.toLocaleTimeString('id-ID');
            const dateString = now.toLocaleDateString('id-ID');
            const dayString = now.toLocaleDateString('id-ID', { weekday: 'long' });
            document.getElementById('current-time').textContent = timeString;
            document.getElementById('current-date').textContent = dateString;
            document.getElementById('current-day').textContent = dayString;
        }
        setInterval(updateTime, 1000);
        updateTime();

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
