@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Design Factor 1</h4>
                </div>

                <!-- Card Body -->
                <div class="card-body p-5">
                    <!-- Form Assessment -->
                    <form action="{{ route('df1.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        <!-- Assessment Items -->
                        @foreach([
                            'strategy_archetype' => 'Growth/Acquisition',
                            'current_performance' => 'Innovation/Differentiation',
                            'future_goals' => 'Cost Leadership',
                            'alignment_with_it' => 'Client Service/Stability'
                        ] as $name => $label)
                            <div class="assessment-item card mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <!-- Label -->
                                        <div class="col-md-4">
                                            <h6 class="mb-0 text-primary">{{ $label }}</h6>
                                        </div>

                                        <!-- Rating Options -->
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" 
                                                               name="{{ $name }}" id="{{ $name }}{{ $i }}" 
                                                               value="{{ $i }}" required>
                                                        <label class="form-check-label small" 
                                                               for="{{ $name }}{{ $i }}">{{ $i }}</label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Chart Section -->
                        <div class="row mb-4">
                            <!-- Bar Chart -->
                            <div class="col-md-6">
                                <div class="chart-container" style="height: 200px;">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>

                            <!-- Radar Chart -->
                            <div class="col-md-6">
                                <div class="chart-container" style="height: 200px;">
                                    <canvas id="radarChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                Submit Assessment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    const radarCtx = document.getElementById('radarChart').getContext('2d');

    // Data awal dengan label yang sesuai form
    const initialData = {
        labels: [
            'Growth/Acquisition', 
            'Innovation/Differentiation', 
            'Cost Leadership', 
            'Client Service/Stability'
        ],
        datasets: [{
            label: 'Scores',
            data: [0, 0, 0, 0],
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    // Konfigurasi Bar Chart
    const barConfig = {
        type: 'bar',
        data: initialData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                x: {
                    max: 5,
                    display: false
                },
                y: {
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    };

    // Konfigurasi Radar Chart
    const radarConfig = {
        type: 'radar',
        data: {
            labels: initialData.labels,
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
                    ticks: {
                        stepSize: 1,
                        display: false
                    },
                    pointLabels: {
                        font: {
                            size: 12
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    };

    // Buat kedua chart
    const barChart = new Chart(barCtx, barConfig);
    const radarChart = new Chart(radarCtx, radarConfig);

    // Fungsi update chart
    function updateCharts() {
        const scores = {
            strategy: document.querySelector('input[name="strategy_archetype"]:checked')?.value || 0,
            performance: document.querySelector('input[name="current_performance"]:checked')?.value || 0,
            goals: document.querySelector('input[name="future_goals"]:checked')?.value || 0,
            alignment: document.querySelector('input[name="alignment_with_it"]:checked')?.value || 0
        };
        const newData = [
            parseFloat(scores.strategy),
            parseFloat(scores.performance),
            parseFloat(scores.goals),
            parseFloat(scores.alignment)
        ];

        // Update Bar Chart
        barChart.data.datasets[0].data = newData;
        barChart.update();

        // Update Radar Chart
        radarChart.data.datasets[0].data = newData;
        radarChart.update();
    }

    // Event listener untuk radio button
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', updateCharts);
    });
});
</script>

<!-- Custom CSS -->
<style>
.assessment-item {
    transition: transform 0.2s;
}
.assessment-item:hover {
    transform: translateY(-2px);
}
.form-check-input {
    cursor: pointer;
}
.form-check-label {
    cursor: pointer;
    user-select: none;
}
.chart-container {
    position: relative;
    margin: auto;
    width: 100%;
}
</style>
@endsection