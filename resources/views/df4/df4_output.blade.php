@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Output Data Design Factor 4</h2>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan data Design Factor 4 -->
    @if($designFactor4)
        <h3>Design Factor 4</h3>
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
                    <th>Input 20</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $designFactor4->df_id }}</td>
                    <td>{{ $designFactor4->input1df4 }}</td>
                    <td>{{ $designFactor4->input2df4 }}</td>
                    <td>{{ $designFactor4->input3df4 }}</td>
                    <td>{{ $designFactor4->input4df4 }}</td>
                    <td>{{ $designFactor4->input5df4 }}</td>
                    <td>{{ $designFactor4->input6df4 }}</td>
                    <td>{{ $designFactor4->input7df4 }}</td>
                    <td>{{ $designFactor4->input8df4 }}</td>
                    <td>{{ $designFactor4->input9df4 }}</td>
                    <td>{{ $designFactor4->input10df4 }}</td>
                    <td>{{ $designFactor4->input11df4 }}</td>
                    <td>{{ $designFactor4->input12df4 }}</td>
                    <td>{{ $designFactor4->input13df4 }}</td>
                    <td>{{ $designFactor4->input14df4 }}</td>
                    <td>{{ $designFactor4->input15df4 }}</td>
                    <td>{{ $designFactor4->input16df4 }}</td>
                    <td>{{ $designFactor4->input17df4 }}</td>
                    <td>{{ $designFactor4->input18df4 }}</td>
                    <td>{{ $designFactor4->input19df4 }}</td>
                    <td>{{ $designFactor4->input20df4 }}</td>
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
            {{ $designFactorRelativeImportance->r_df4_1 }},
            {{ $designFactorRelativeImportance->r_df4_2 }},
            {{ $designFactorRelativeImportance->r_df4_3 }},
            {{ $designFactorRelativeImportance->r_df4_4 }},
            {{ $designFactorRelativeImportance->r_df4_5 }},
            {{ $designFactorRelativeImportance->r_df4_6 }},
            {{ $designFactorRelativeImportance->r_df4_7 }},
            {{ $designFactorRelativeImportance->r_df4_8 }},
            {{ $designFactorRelativeImportance->r_df4_9 }},
            {{ $designFactorRelativeImportance->r_df4_10 }},
            {{ $designFactorRelativeImportance->r_df4_11 }},
            {{ $designFactorRelativeImportance->r_df4_12 }},
            {{ $designFactorRelativeImportance->r_df4_13 }},
            {{ $designFactorRelativeImportance->r_df4_14 }},
            {{ $designFactorRelativeImportance->r_df4_15 }},
            {{ $designFactorRelativeImportance->r_df4_16 }},
            {{ $designFactorRelativeImportance->r_df4_17 }},
            {{ $designFactorRelativeImportance->r_df4_18 }},
            {{ $designFactorRelativeImportance->r_df4_19 }},
            {{ $designFactorRelativeImportance->r_df4_20 }},
            {{ $designFactorRelativeImportance->r_df4_21 }},
            {{ $designFactorRelativeImportance->r_df4_22 }},
            {{ $designFactorRelativeImportance->r_df4_23 }},
            {{ $designFactorRelativeImportance->r_df4_24 }},
            {{ $designFactorRelativeImportance->r_df4_25 }},
            {{ $designFactorRelativeImportance->r_df4_26 }},
            {{ $designFactorRelativeImportance->r_df4_27 }},
            {{ $designFactorRelativeImportance->r_df4_28 }},
            {{ $designFactorRelativeImportance->r_df4_29 }},
            {{ $designFactorRelativeImportance->r_df4_30 }},
            {{ $designFactorRelativeImportance->r_df4_31 }},
            {{ $designFactorRelativeImportance->r_df4_32 }},
            {{ $designFactorRelativeImportance->r_df4_33 }},
            {{ $designFactorRelativeImportance->r_df4_34 }},
            {{ $designFactorRelativeImportance->r_df4_35 }},
            {{ $designFactorRelativeImportance->r_df4_36 }},
            {{ $designFactorRelativeImportance->r_df4_37 }},
            {{ $designFactorRelativeImportance->r_df4_38 }},
            {{ $designFactorRelativeImportance->r_df4_39 }},
            {{ $designFactorRelativeImportance->r_df4_40 }}
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
