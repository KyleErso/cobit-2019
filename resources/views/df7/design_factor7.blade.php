@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Design Factor 7</div>
                <div class="card-body">
                    <!-- Form action pointing to the correct route -->
                    <form action="{{ route('df7.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        <!-- Input Fields for df7 -->
                        @php
                            $fields = [
                                'Support',
                                'Factory',
                                'Turnaround',
                                'Strategic'
                            ];
                        @endphp

                        @foreach ($fields as $index => $label)
                            <div class="assessment-item card mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h6 class="mb-0 text-primary">{{ $label }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <div class="form-check">
                                                        <input class="form-check-input input-score" type="radio"
                                                            name="input{{ $index + 1 }}df7" id="input{{ $index + 1 }}df7_{{ $i }}"
                                                            value="{{ $i }}" required>
                                                        <label class="form-check-label small"
                                                            for="input{{ $index + 1 }}df7_{{ $i }}">{{ $i }}</label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Chart Container -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="chart-container" style="height: 200px;">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="chart-container" style="height: 200px;">
                                    <canvas id="radarChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Submit Assessment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize charts
        const barCtx = document.getElementById('barChart').getContext('2d');
        const radarCtx = document.getElementById('radarChart').getContext('2d');

        // Initial data with updated labels
        const initialData = {
            labels: ['Support', 'Factory', 'Turnaround', 'Strategic'],
            datasets: [{
                label: 'Scores',
                data: [0, 0, 0, 0],
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
                    x: {
                        max: 5, // Updated to support values from 1 to 5
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

        // Radar Chart Configuration
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
                        max: 5, // Updated to support values from 1 to 5
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

        // Create charts
        const barChart = new Chart(barCtx, barConfig);
        const radarChart = new Chart(radarCtx, radarConfig);

        // Update charts on input change
        function updateCharts() {
            const scores = [
                parseFloat(document.querySelector('input[name="input1df7"]:checked')?.value || 0),
                parseFloat(document.querySelector('input[name="input2df7"]:checked')?.value || 0),
                parseFloat(document.querySelector('input[name="input3df7"]:checked')?.value || 0),
                parseFloat(document.querySelector('input[name="input4df7"]:checked')?.value || 0)
            ];

            // Update Bar Chart
            barChart.data.datasets[0].data = scores;
            barChart.update();

            // Update Radar Chart
            radarChart.data.datasets[0].data = scores;
            radarChart.update();
        }

        // Add event listeners to inputs
        document.querySelectorAll('.input-score').forEach(input => {
            input.addEventListener('change', updateCharts);
        });
    });
</script>
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
        transition: transform 0.2s;
    }

    .chart-container:hover {
        transform: translateY(-2px);
    }
</style>
@endsection