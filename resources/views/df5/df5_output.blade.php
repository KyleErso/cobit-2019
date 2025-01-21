@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Output Data Design Factor 5</h2>

    <!-- Display success message if available -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Design Factor 5 data -->
    @if($designFactor5)
            <h3>Design Factor 5</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>DF ID</th>
                        <th>Input 1</th>
                        <th>Input 2</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $designFactor5->df_id }}</td>
                        <td>{{ $designFactor5->input1df5 }}</td>
                        <td>{{ $designFactor5->input2df5 }}</td>
                    </tr>
                </tbody>
            </table>

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
                    {{ $designFactorRelativeImportance->r_df5_1 }},
                    {{ $designFactorRelativeImportance->r_df5_2 }},
                    {{ $designFactorRelativeImportance->r_df5_3 }},
                    {{ $designFactorRelativeImportance->r_df5_4 }},
                    {{ $designFactorRelativeImportance->r_df5_5 }},
                    {{ $designFactorRelativeImportance->r_df5_6 }},
                    {{ $designFactorRelativeImportance->r_df5_7 }},
                    {{ $designFactorRelativeImportance->r_df5_8 }},
                    {{ $designFactorRelativeImportance->r_df5_9 }},
                    {{ $designFactorRelativeImportance->r_df5_10 }},
                    {{ $designFactorRelativeImportance->r_df5_11 }},
                    {{ $designFactorRelativeImportance->r_df5_12 }},
                    {{ $designFactorRelativeImportance->r_df5_13 }},
                    {{ $designFactorRelativeImportance->r_df5_14 }},
                    {{ $designFactorRelativeImportance->r_df5_15 }},
                    {{ $designFactorRelativeImportance->r_df5_16 }},
                    {{ $designFactorRelativeImportance->r_df5_17 }},
                    {{ $designFactorRelativeImportance->r_df5_18 }},
                    {{ $designFactorRelativeImportance->r_df5_19 }},
                    {{ $designFactorRelativeImportance->r_df5_20 }},
                    {{ $designFactorRelativeImportance->r_df5_21 }},
                    {{ $designFactorRelativeImportance->r_df5_22 }},
                    {{ $designFactorRelativeImportance->r_df5_23 }},
                    {{ $designFactorRelativeImportance->r_df5_24 }},
                    {{ $designFactorRelativeImportance->r_df5_25 }},
                    {{ $designFactorRelativeImportance->r_df5_26 }},
                    {{ $designFactorRelativeImportance->r_df5_27 }},
                    {{ $designFactorRelativeImportance->r_df5_28 }},
                    {{ $designFactorRelativeImportance->r_df5_29 }},
                    {{ $designFactorRelativeImportance->r_df5_30 }},
                    {{ $designFactorRelativeImportance->r_df5_31 }},
                    {{ $designFactorRelativeImportance->r_df5_32 }},
                    {{ $designFactorRelativeImportance->r_df5_33 }},
                    {{ $designFactorRelativeImportance->r_df5_34 }},
                    {{ $designFactorRelativeImportance->r_df5_35 }},
                    {{ $designFactorRelativeImportance->r_df5_36 }},
                    {{ $designFactorRelativeImportance->r_df5_37 }},
                    {{ $designFactorRelativeImportance->r_df5_38 }},
                    {{ $designFactorRelativeImportance->r_df5_39 }},
                    {{ $designFactorRelativeImportance->r_df5_40 }}
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
                // Membalik urutan label dan data untuk membuat label terbalik dari arah jam
                const reversedLabels = [...relativeImportanceLabels].reverse();
                const reversedValues = [...relativeImportanceValues].reverse();
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
        </div>
    @else
        <p>Data tidak ditemukan</p>
    @endif
@endsection