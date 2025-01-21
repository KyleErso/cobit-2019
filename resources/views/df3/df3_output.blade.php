@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Output Data Design Factor 3</h2>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan data Design Factor 3A -->
    @if($designFactor3a)
        <h3>Design Factor 3A</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>DF ID</th>
                    <th>Input 1</th>
                    <th>Input 2</th>
                    <th>Input 3</th>
                    <th>Input 4</th>
                    <th>Input 5</th>
                    <th>Input 6</th>
                    <th>Input 7</th>
                    <th>Input 8</th>
                    <th>Input 9</th>
                    <th>Input 10</th>
                    <th>Input 11</th>
                    <th>Input 12</th>
                    <th>Input 13</th>
                    <th>Input 14</th>
                    <th>Input 15</th>
                    <th>Input 16</th>
                    <th>Input 17</th>
                    <th>Input 18</th>
                    <th>Input 19</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $designFactor3a->df_id }}</td>
                    <td>{{ $designFactor3a->input1df3 }}</td>
                    <td>{{ $designFactor3a->input2df3 }}</td>
                    <td>{{ $designFactor3a->input3df3 }}</td>
                    <td>{{ $designFactor3a->input4df3 }}</td>
                    <td>{{ $designFactor3a->input5df3 }}</td>
                    <td>{{ $designFactor3a->input6df3 }}</td>
                    <td>{{ $designFactor3a->input7df3 }}</td>
                    <td>{{ $designFactor3a->input8df3 }}</td>
                    <td>{{ $designFactor3a->input9df3 }}</td>
                    <td>{{ $designFactor3a->input10df3 }}</td>
                    <td>{{ $designFactor3a->input11df3 }}</td>
                    <td>{{ $designFactor3a->input12df3 }}</td>
                    <td>{{ $designFactor3a->input13df3 }}</td>
                    <td>{{ $designFactor3a->input14df3 }}</td>
                    <td>{{ $designFactor3a->input15df3 }}</td>
                    <td>{{ $designFactor3a->input16df3 }}</td>
                    <td>{{ $designFactor3a->input17df3 }}</td>
                    <td>{{ $designFactor3a->input18df3 }}</td>
                    <td>{{ $designFactor3a->input19df3 }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Data Design Factor 3A tidak ditemukan.</p>
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
            {{ $designFactorRelativeImportance->r_df3_1 }},
            {{ $designFactorRelativeImportance->r_df3_2 }},
            {{ $designFactorRelativeImportance->r_df3_3 }},
            {{ $designFactorRelativeImportance->r_df3_4 }},
            {{ $designFactorRelativeImportance->r_df3_5 }},
            {{ $designFactorRelativeImportance->r_df3_6 }},
            {{ $designFactorRelativeImportance->r_df3_7 }},
            {{ $designFactorRelativeImportance->r_df3_8 }},
            {{ $designFactorRelativeImportance->r_df3_9 }},
            {{ $designFactorRelativeImportance->r_df3_10 }},
            {{ $designFactorRelativeImportance->r_df3_11 }},
            {{ $designFactorRelativeImportance->r_df3_12 }},
            {{ $designFactorRelativeImportance->r_df3_13 }},
            {{ $designFactorRelativeImportance->r_df3_14 }},
            {{ $designFactorRelativeImportance->r_df3_15 }},
            {{ $designFactorRelativeImportance->r_df3_16 }},
            {{ $designFactorRelativeImportance->r_df3_17 }},
            {{ $designFactorRelativeImportance->r_df3_18 }},
            {{ $designFactorRelativeImportance->r_df3_19 }},
            {{ $designFactorRelativeImportance->r_df3_20 }},
            {{ $designFactorRelativeImportance->r_df3_21 }},
            {{ $designFactorRelativeImportance->r_df3_22 }},
            {{ $designFactorRelativeImportance->r_df3_23 }},
            {{ $designFactorRelativeImportance->r_df3_24 }},
            {{ $designFactorRelativeImportance->r_df3_25 }},
            {{ $designFactorRelativeImportance->r_df3_26 }},
            {{ $designFactorRelativeImportance->r_df3_27 }},
            {{ $designFactorRelativeImportance->r_df3_28 }},
            {{ $designFactorRelativeImportance->r_df3_29 }},
            {{ $designFactorRelativeImportance->r_df3_30 }},
            {{ $designFactorRelativeImportance->r_df3_31 }},
            {{ $designFactorRelativeImportance->r_df3_32 }},
            {{ $designFactorRelativeImportance->r_df3_33 }},
            {{ $designFactorRelativeImportance->r_df3_34 }},
            {{ $designFactorRelativeImportance->r_df3_35 }},
            {{ $designFactorRelativeImportance->r_df3_36 }},
            {{ $designFactorRelativeImportance->r_df3_37 }},
            {{ $designFactorRelativeImportance->r_df3_38 }},
            {{ $designFactorRelativeImportance->r_df3_39 }},
            {{ $designFactorRelativeImportance->r_df3_40 }}
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
@endsection