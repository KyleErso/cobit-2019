@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Design Factor 2 - Enterprise Goals</div>
                <div class="card-body">
                    <form action="{{ route('df2.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        <!-- 13 Input Fields dalam Format Radio Button -->
                        <div class="form-group">
                            @php
                                $inputs = [
                                    'input1df2' => 'EG01 - Portfolio of competitive products and services',
                                    'input2df2' => 'EG02 - Managed business risk',
                                    'input3df2' => 'EG03 - Compliance with external laws and regulations',
                                    'input4df2' => 'EG04 - Quality of financial information',
                                    'input5df2' => 'EG05 - Customer-oriented service culture',
                                    'input6df2' => 'EG06 - Business-service continuity and availability',
                                    'input7df2' => 'EG07 - Quality of management information',
                                    'input8df2' => 'EG08 - Optimization of internal business process functionality',
                                    'input9df2' => 'EG09 - Optimization of business process costs',
                                    'input10df2' => 'EG10 - Staff skills, motivation and productivity',
                                    'input11df2' => 'EG11 - Compliance with internal policies',
                                    'input12df2' => 'EG12 - Managed digital transformation programs',
                                    'input13df2' => 'EG13 - Product and business innovation'
                                ];
                            @endphp

                            @foreach($inputs as $name => $label)
                                <div class="assessment-item card mb-3">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <h6 class="mb-0 text-primary">{{ $label }}</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-between">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="{{ $name }}"
                                                                id="{{ $name }}_{{ $i }}" value="{{ $i }}" required>
                                                            <label class="form-check-label small"
                                                                for="{{ $name }}_{{ $i }}">{{ $i }}</label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Chart Container -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="chart-container" style="height: 300px;">
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const barCtx = document.getElementById('barChart').getContext('2d');
        const radarCtx = document.getElementById('radarChart').getContext('2d');

        // Labels tetap EG01 - EG13
        const egLabels = [
            'EG01', 'EG02', 'EG03', 'EG04', 'EG05', 'EG06', 'EG07',
            'EG08', 'EG09', 'EG10', 'EG11', 'EG12', 'EG13'
        ];

        // Nama input dari form (input1df2 - input13df2)
        const inputNames = [
            'input1df2', 'input2df2', 'input3df2', 'input4df2', 'input5df2',
            'input6df2', 'input7df2', 'input8df2', 'input9df2', 'input10df2',
            'input11df2', 'input12df2', 'input13df2'
        ];

        const initialData = {
            labels: egLabels,
            datasets: [{
                label: 'Scores',
                data: new Array(13).fill(0),
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

        const barChart = new Chart(barCtx, barConfig);
        const radarChart = new Chart(radarCtx, radarConfig);

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

        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', updateCharts);
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
</style>
@endsection