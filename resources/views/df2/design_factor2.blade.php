@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Design Factor 2 - Enterprise Goals</h4>
                </div>

                <!-- Scrollspy Area (Only for Assessment Items) -->
                <div class="card-body p-5" data-bs-spy="scroll" data-bs-target="#scrollspy-nav" data-bs-offset="0" tabindex="0" style="max-height: 400px; overflow-y: auto;">
                    <form action="{{ route('df2.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        <!-- Penjelasan Design Factor 2 -->
                        <p class="mb-4">
                            <strong>Enterprise goals supporting the enterprise strategy:</strong><br>
                            Enterprise strategy is realized by the achievement of a set of enterprise goals. 
                            These goals are defined in the COBIT framework, structured along the balanced scorecard (BSC) dimensions, 
                            and include the elements shown in the table below:
                        </p>

                        <!-- Tabel dengan Radio Button -->
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Balanced Scorecard Dimension</th>
                                    <th scope="col">Enterprise Goal</th>
                                    <th scope="col">Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $inputs = [
                                        'input1df2' => ['EG01', 'Financial', 'Portfolio of competitive products and services'],
                                        'input2df2' => ['EG02', 'Financial', 'Managed business risk'],
                                        'input3df2' => ['EG03', 'Financial', 'Compliance with external laws and regulations'],
                                        'input4df2' => ['EG04', 'Financial', 'Quality of financial information'],
                                        'input5df2' => ['EG05', 'Customer', 'Customer-oriented service culture'],
                                        'input6df2' => ['EG06', 'Customer', 'Business-service continuity and availability'],
                                        'input7df2' => ['EG07', 'Customer', 'Quality of management information'],
                                        'input8df2' => ['EG08', 'Internal', 'Optimization of internal business process functionality'],
                                        'input9df2' => ['EG09', 'Internal', 'Optimization of business process costs'],
                                        'input10df2' => ['EG10', 'Internal', 'Staff skills, motivation and productivity'],
                                        'input11df2' => ['EG11', 'Internal', 'Compliance with internal policies'],
                                        'input12df2' => ['EG12', 'Growth', 'Managed digital transformation programs'],
                                        'input13df2' => ['EG13', 'Growth', 'Product and business innovation']
                                    ];
                                @endphp

                                @foreach($inputs as $name => $data)
                                    <tr class="assessment-item">
                                        <td class="text-primary fw-bold">{{ $data[0] }}</td> <!-- Kode EG -->
                                        <td>{{ $data[1] }}</td> <!-- Balanced Scorecard Dimension -->
                                        <td>{{ $data[2] }}</td> <!-- Enterprise Goal -->
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" 
                                                               name="{{ $name }}" id="{{ $name }}_{{ $i }}" 
                                                               value="{{ $i }}" required>
                                                        <label class="form-check-label small" 
                                                               for="{{ $name }}_{{ $i }}">{{ $i }}</label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                </div>

                <!-- Chart Section (Outside Scrollspy) -->
                <div class="card-footer bg-light p-5">
                    <div class="row mb-4">
                        <!-- Bar Chart -->
                        <div class="col-md-6">
                            <div class="chart-container" style="height: 300px;">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                        <!-- Radar Chart -->
                        <div class="col-md-6">
                            <div class="chart-container" style="height: 300px;">
                                <canvas id="radarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-4 mb-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        Submit Assessment
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Navigation for Scrollspy -->
<div id="scrollspy-nav" class="d-none">
    @foreach($inputs as $name => $data)
        <a href="#{{ $name }}-section">{{ $data[0] }} - {{ $data[2] }}</a>
    @endforeach
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Chart Contexts
    const barCtx = document.getElementById('barChart').getContext('2d');
    const radarCtx = document.getElementById('radarChart').getContext('2d');

    // Labels and Input Names
    const egLabels = [
        'EG01', 'EG02', 'EG03', 'EG04', 'EG05', 'EG06', 'EG07',
        'EG08', 'EG09', 'EG10', 'EG11', 'EG12', 'EG13'
    ];
    const inputNames = Object.keys(@json($inputs));

    // Initial Data
    const initialData = {
        labels: egLabels,
        datasets: [{
            label: 'Scores',
            data: new Array(egLabels.length).fill(0),
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    // Bar Chart Configuration
    const barConfig = {
        type: 'bar',
        data: initialData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                x: { max: 5, display: false },
                y: { ticks: { font: { size: 12 } } }
            },
            plugins: { legend: { display: false }, tooltip: { enabled: false } }
        }
    };

    // Radar Chart Configuration
    const radarConfig = {
        type: 'radar',
        data: {
            labels: egLabels,
            datasets: [{
                label: 'Score Profile',
                data: initialData.datasets[0].data,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(255, 99, 132, 1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 5,
                    ticks: { stepSize: 1, display: false },
                    pointLabels: { font: { size: 12 } }
                }
            },
            plugins: { legend: { display: false }, tooltip: { enabled: false } }
        }
    };

    // Create Charts
    const barChart = new Chart(barCtx, barConfig);
    const radarChart = new Chart(radarCtx, radarConfig);

    // Update Charts Function
    function updateCharts() {
        const scores = inputNames.map(name => {
            const selected = document.querySelector(`input[name="${name}"]:checked`);
            return selected ? parseFloat(selected.value) : 0;
        });
        barChart.data.datasets[0].data = scores;
        barChart.update();
        radarChart.data.datasets[0].data = scores;
        radarChart.update();
    }

    // Add Event Listeners to Radio Buttons
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', updateCharts);
    });
});
</script>

<!-- Custom CSS -->
<style>
/* Efek Hover pada Baris Tabel */
.assessment-item {
    transition: transform 0.2s, box-shadow 0.2s;
}
.assessment-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Gaya untuk Radio Button */
.form-check-input {
    cursor: pointer;
}
.form-check-label {
    cursor: pointer;
    user-select: none;
}

/* Gaya untuk Grafik */
.chart-container {
    position: relative;
    margin: auto;
    width: 100%;
}

/* Gaya untuk Footer */
.card-footer {
    border-top: 1px solid #ddd;
}
</style>
@endsection