@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center font-weight-bold">Design Factor 4</div>
                <div class="card-body">
                    <form id="df4Form" action="{{ route('df4.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        @php
                        $labels = [
                            "Frustration between different IT entities across the organization",
                            "Frustration between business departments and the IT department",
                            "Significant IT-related incidents (e.g., data loss, security breaches)",
                            "Service delivery problems by IT outsourcers",
                            "Failures to meet IT-related regulatory or contractual requirements",
                            "Regular audit findings about poor IT performance",
                            "Substantial hidden and rogue IT spending",
                            "Duplications or overlaps causing wasted resources",
                            "Insufficient IT resources or staff dissatisfaction",
                            "IT-enabled projects failing to meet business needs",
                            "Reluctance by senior management to engage with IT",
                            "Complex IT operating model and unclear decision mechanisms",
                            "Excessively high IT costs",
                            "Obstructed implementation of new initiatives due to IT architecture",
                            "Gap between business and technical knowledge",
                            "Issues with data quality and integration across sources",
                            "High level of end-user computing causing oversight issues",
                            "Business units implementing IT solutions without enterprise IT involvement",
                            "Noncompliance with privacy regulations",
                            "Inability to exploit new technologies or innovate using IT"
                        ];
                        @endphp

                        @foreach ($labels as $index => $label)
                        <div class="assessment-item card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h6 class="mb-0 text-primary">{{ $label }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between">
                                            @for ($i = 1; $i <= 3; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input input-score" type="radio" 
                                                       name="input{{ $index+1 }}df4" 
                                                       id="input{{ $index+1 }}df4_{{ $i }}" 
                                                       value="{{ $i }}" required>
                                                <label class="form-check-label small" 
                                                       for="input{{ $index+1 }}df4_{{ $i }}">{{ $i }}</label>
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Chart Container -->
                        <div class="row mb-4">
                            <div class="col-md">
                                <div class="chart-container" style="height: 400px; width: 100%;">
                                    <canvas id="barChart"></canvas>
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
<!-- Sertakan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const labels = [
            "Frustration between different IT entities",
            "Frustration between business and IT",
            "Significant IT-related incidents",
            "Service delivery problems",
            "Failures to meet IT-related requirements",
            "Audit findings on poor IT performance",
            "Hidden and rogue IT spending",
            "Duplications or wasted resources",
            "Insufficient IT resources/staff dissatisfaction",
            "IT-enabled projects failing",
            "Management reluctance to engage with IT",
            "Complex IT operating model",
            "High IT costs",
            "Obstructed IT implementation",
            "Business vs. technical knowledge gap",
            "Data quality and integration issues",
            "High end-user computing reliance",
            "Business units implementing IT independently",
            "Noncompliance with privacy regulations",
            "Inability to innovate with IT"
        ];

        let scores = new Array(labels.length).fill(0);

        // Inisialisasi Bar Chart
        const barChart = new Chart(document.getElementById('barChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Risk Score',
                    data: scores,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 3,
                        ticks: {
                            stepSize: 1,
                            autoSkip: false
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 12
                            },
                            autoSkip: false
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                }
            }
        });


        // Update Chart berdasarkan input pengguna
        document.querySelectorAll('.input-score').forEach(input => {
            input.addEventListener('change', function () {
                let index = parseInt(this.name.replace('input', '').replace('df4', '')) - 1;
                scores[index] = parseInt(this.value);
                barChart.data.datasets[0].data = scores;
                barChart.update();
            });
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
        position: relative;
    }
</style>
@endsection

