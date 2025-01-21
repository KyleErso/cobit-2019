@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Output Data Design Factor 7</h2>

    <!-- Display success message if available -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Design Factor 7 data -->
    @if($designFactor7)
        <h3>Design Factor 7</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>DF ID</th>
                    <th>Input 1</th>
                    <th>Input 2</th>
                    <th>Input 3</th>
                    <th>Input 4</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $designFactor7->df_id }}</td>
                    <td>{{ $designFactor7->input1df7 }}</td>
                    <td>{{ $designFactor7->input2df7 }}</td>
                    <td>{{ $designFactor7->input3df7 }}</td>
                    <td>{{ $designFactor7->input4df7 }}</td>
                </tr>
            </tbody>
        </table>
    @endif

    <!-- Chart for Relative Importance (Bar Chart) -->
    <h3>Relative Importance Bar Chart</h3>
    <canvas id="relativeImportanceBarChart" width="400" height="200"></canvas>

    <!-- Chart for Relative Importance (Radar Chart) -->
    <h3>Relative Importance Radar Chart</h3>
    <canvas id="relativeImportanceRadarChart" width="400" height="200"></canvas>
</div>

<!-- Script for Chart.js Initialization -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data input from controller for relative importance
        const relativeImportanceValues = [
            {{ $designFactorRelativeImportance->r_df7_1 }},
            {{ $designFactorRelativeImportance->r_df7_2 }},
            {{ $designFactorRelativeImportance->r_df7_3 }},
            {{ $designFactorRelativeImportance->r_df7_4 }},
            {{ $designFactorRelativeImportance->r_df7_5 }},
            {{ $designFactorRelativeImportance->r_df7_6 }},
            {{ $designFactorRelativeImportance->r_df7_7 }},
            {{ $designFactorRelativeImportance->r_df7_8 }},
            {{ $designFactorRelativeImportance->r_df7_9 }},
            {{ $designFactorRelativeImportance->r_df7_10 }},
            {{ $designFactorRelativeImportance->r_df7_11 }},
            {{ $designFactorRelativeImportance->r_df7_12 }},
            {{ $designFactorRelativeImportance->r_df7_13 }},
            {{ $designFactorRelativeImportance->r_df7_14 }},
            {{ $designFactorRelativeImportance->r_df7_15 }},
            {{ $designFactorRelativeImportance->r_df7_16 }},
            {{ $designFactorRelativeImportance->r_df7_17 }},
            {{ $designFactorRelativeImportance->r_df7_18 }},
            {{ $designFactorRelativeImportance->r_df7_19 }},
            {{ $designFactorRelativeImportance->r_df7_20 }},
            {{ $designFactorRelativeImportance->r_df7_21 }},
            {{ $designFactorRelativeImportance->r_df7_22 }},
            {{ $designFactorRelativeImportance->r_df7_23 }},
            {{ $designFactorRelativeImportance->r_df7_24 }},
            {{ $designFactorRelativeImportance->r_df7_25 }},
            {{ $designFactorRelativeImportance->r_df7_26 }},
            {{ $designFactorRelativeImportance->r_df7_27 }},
            {{ $designFactorRelativeImportance->r_df7_28 }},
            {{ $designFactorRelativeImportance->r_df7_29 }},
            {{ $designFactorRelativeImportance->r_df7_30 }},
            {{ $designFactorRelativeImportance->r_df7_31 }},
            {{ $designFactorRelativeImportance->r_df7_32 }},
            {{ $designFactorRelativeImportance->r_df7_33 }},
            {{ $designFactorRelativeImportance->r_df7_34 }},
            {{ $designFactorRelativeImportance->r_df7_35 }},
            {{ $designFactorRelativeImportance->r_df7_36 }},
            {{ $designFactorRelativeImportance->r_df7_37 }},
            {{ $designFactorRelativeImportance->r_df7_38 }},
            {{ $designFactorRelativeImportance->r_df7_39 }},
            {{ $designFactorRelativeImportance->r_df7_40 }}
        ];

        // Labels for the relative importance scores
        const relativeImportanceLabels = [
            'EDM01', 'EDM02', 'EDM03', 'EDM04', 'EDM05',
            'APO01', 'APO02', 'APO03', 'APO04', 'APO05',
            'APO06', 'APO07', 'APO08', 'APO09', 'APO10',
            'APO11', 'APO12', 'APO13', 'APO14', 'BAI01',
            'BAI02', 'BAI03', 'BAI04', 'BAI05', 'BAI06',
            'BAI07', 'BAI08', 'BAI09', 'BAI10', 'BAI11',
            'DSS01', 'DSS02', 'DSS03', 'DSS04', 'DSS05',
            'DSS06', 'MEA01', 'MEA02', 'MEA03', 'MEA04'
        ];

        // Bar Chart Initialization
        const ctxBar = document.getElementById('relativeImportanceBarChart').getContext('2d');
        const barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: relativeImportanceLabels,
                datasets: [{
                    label: 'Relative Importance Score',
                    data: relativeImportanceValues,
                    backgroundColor: relativeImportanceValues.map(value => value > 0 ? 'rgba(54, 162, 235, 0.6)' : value < 0 ? 'rgba(255, 99, 132, 0.6)' : 'rgba(201, 201, 201, 0.6)'),
                    borderColor: relativeImportanceValues.map(value => value > 0 ? 'rgba(54, 162, 235, 1)' : value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(201, 201, 201, 1)'),
                }]
            },
            options: {
                indexAxis: 'y',
                maintainAspectRatio: true,
                responsive: true,
                scales: {
                    x: {
                        max: 100,
                        min: -100,
                        beginAtZero: true,
                        ticks: {
                            stepSize: 20
                        },
                        grid: {
                            color: function (context) {
                                return context.tick.value === 0 ? 'rgba(0, 0, 0, 0.3)' : 'rgba(200, 200, 200, 0.3)';
                            },
                            lineWidth: function (context) {
                                return context.tick.value === 0 ? 2 : 1;
                            }
                        }
                    },
                    y: {
                        ticks: {
                            maxTicksLimit: 40,
                            autoSkip: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.raw >= 0 ? '+' + context.raw : context.raw;
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Radar Chart Initialization
        const ctxRadar = document.getElementById('relativeImportanceRadarChart').getContext('2d');
        const radarChart = new Chart(ctxRadar, {
            type: 'radar',
            data: {
                labels: relativeImportanceLabels,
                datasets: [{
                    label: 'Relative Importance',
                    data: relativeImportanceValues,
                    backgroundColor: 'rgba(235, 54, 54, 0.2)', // Warna latar belakang
                    borderColor: relativeImportanceValues.map(value =>
                        value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)' // Warna garis: merah untuk negatif, biru untuk positif
                    ),
                    borderWidth: 2,
                    pointBackgroundColor: relativeImportanceValues.map(value =>
                        value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)' // Warna titik: merah untuk negatif, biru untuk positif
                    ),
                    pointBorderColor: '#fff', // Warna border titik
                    pointHoverBackgroundColor: '#fff', // Warna latar titik saat dihover
                    pointHoverBorderColor: relativeImportanceValues.map(value =>
                        value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)' // Warna border titik saat dihover
                    ),
                    borderJoinStyle: 'round', // Membuat garis terlihat halus
                    tension: 0.4 // Membuat garis lebih melengkung dan halus
                }]
            },
            options: {
                scales: {
                    r: {
                        suggestedMin: -100,
                        suggestedMax: 100,
                        ticks: {
                            stepSize: 25,
                            backdropColor: 'transparent' // Menghilangkan backdrop pada angka skala
                        },
                        pointLabels: {
                            fontSize: 10,
                            color: '#333' // Warna font untuk label
                        },
                        angleLines: {
                            color: 'rgba(200, 200, 200, 0.3)' // Warna garis sudut
                        },
                        grid: {
                            color: 'rgba(200, 200, 200, 0.3)' // Warna grid
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Menyembunyikan legenda
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.raw >= 0 ? '+' + context.raw : context.raw;
                                return label;
                            }
                        }
                    }
                },
                elements: {
                    line: {
                        tension: 0.4 // Membuat garis lebih melengkung dan halus
                    }
                }
            }
        });
    });
</script>
@endsection