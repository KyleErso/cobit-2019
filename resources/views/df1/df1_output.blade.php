@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Output Data Design Factor 1</h2>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel data untuk verifikasi (opsional) -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>DF ID</th>
                <th>Strategy Archetype</th>
                <th>Current Performance</th>
                <th>Future Goals</th>
                <th>Alignment with IT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $designFactor->df_id }}</td>
                <td>{{ $designFactor->input1df1 }}</td>
                <td>{{ $designFactor->input2df1 }}</td>
                <td>{{ $designFactor->input3df1 }}</td>
                <td>{{ $designFactor->input4df1 }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Tabel untuk Relative Importance Scores -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>EDM01</th>
                    <th>EDM02</th>
                    <th>EDM03</th>
                    <th>EDM04</th>
                    <th>EDM05</th>
                    <th>APO01</th>
                    <th>APO02</th>
                    <th>APO03</th>
                    <th>APO04</th>
                    <th>APO05</th>
                    <th>APO06</th>
                    <th>APO07</th>
                    <th>APO08</th>
                    <th>APO09</th>
                    <th>APO10</th>
                    <th>APO11</th>
                    <th>APO12</th>
                    <th>APO13</th>
                    <th>APO14</th>
                    <th>BAI01</th>
                    <th>BAI02</th>
                    <th>BAI03</th>
                    <th>BAI04</th>
                    <th>BAI05</th>
                    <th>BAI06</th>
                    <th>BAI07</th>
                    <th>BAI08</th>
                    <th>BAI09</th>
                    <th>BAI10</th>
                    <th>BAI11</th>
                    <th>DSS01</th>
                    <th>DSS02</th>
                    <th>DSS03</th>
                    <th>DSS04</th>
                    <th>DSS05</th>
                    <th>DSS06</th>
                    <th>MEA01</th>
                    <th>MEA02</th>
                    <th>MEA03</th>
                    <th>MEA04</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ ($designFactorScore->s_df1_1) }}</td>
                    <td>{{ ($designFactorScore->s_df1_2) }}</td>
                    <td>{{ ($designFactorScore->s_df1_3) }}</td>
                    <td>{{ ($designFactorScore->s_df1_4) }}</td>
                    <td>{{ ($designFactorScore->s_df1_5) }}</td>
                    <td>{{ ($designFactorScore->s_df1_6) }}</td>
                    <td>{{ ($designFactorScore->s_df1_7) }}</td>
                    <td>{{ ($designFactorScore->s_df1_8) }}</td>
                    <td>{{ ($designFactorScore->s_df1_9) }}</td>
                    <td>{{ ($designFactorScore->s_df1_10) }}</td>
                    <td>{{ ($designFactorScore->s_df1_11) }}</td>
                    <td>{{ ($designFactorScore->s_df1_12) }}</td>
                    <td>{{ ($designFactorScore->s_df1_13) }}</td>
                    <td>{{ ($designFactorScore->s_df1_14) }}</td>
                    <td>{{ ($designFactorScore->s_df1_15) }}</td>
                    <td>{{ ($designFactorScore->s_df1_16) }}</td>
                    <td>{{ ($designFactorScore->s_df1_17) }}</td>
                    <td>{{ ($designFactorScore->s_df1_18) }}</td>
                    <td>{{ ($designFactorScore->s_df1_19) }}</td>
                    <td>{{ ($designFactorScore->s_df1_20) }}</td>
                    <td>{{ ($designFactorScore->s_df1_21) }}</td>
                    <td>{{ ($designFactorScore->s_df1_22) }}</td>
                    <td>{{ ($designFactorScore->s_df1_23) }}</td>
                    <td>{{ ($designFactorScore->s_df1_24) }}</td>
                    <td>{{ ($designFactorScore->s_df1_25) }}</td>
                    <td>{{ ($designFactorScore->s_df1_26) }}</td>
                    <td>{{ ($designFactorScore->s_df1_27) }}</td>
                    <td>{{ ($designFactorScore->s_df1_28) }}</td>
                    <td>{{ ($designFactorScore->s_df1_29) }}</td>
                    <td>{{ ($designFactorScore->s_df1_30) }}</td>
                    <td>{{ ($designFactorScore->s_df1_31) }}</td>
                    <td>{{ ($designFactorScore->s_df1_32) }}</td>
                    <td>{{ ($designFactorScore->s_df1_33) }}</td>
                    <td>{{ ($designFactorScore->s_df1_34) }}</td>
                    <td>{{ ($designFactorScore->s_df1_35) }}</td>
                    <td>{{ ($designFactorScore->s_df1_36) }}</td>
                    <td>{{ ($designFactorScore->s_df1_37) }}</td>
                    <td>{{ ($designFactorScore->s_df1_38) }}</td>
                    <td>{{ ($designFactorScore->s_df1_39) }}</td>
                    <td>{{ ($designFactorScore->s_df1_40) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Diagram Canvas untuk Performance Analysis -->
    <h3>Performance Analysis Diagram</h3>
    <canvas id="dfChart" width="400" height="100"></canvas>

    <!-- Diagram Canvas untuk Relative Importance -->
    <h3>Performance Analysis Diagram (Relative Importance)</h3>
    <canvas id="relativeImportanceChart" width="400" height="150"></canvas>

    <!-- Diagram Radar untuk Relative Importance -->
    <h3>Radar Chart for Relative Importance</h3>
    <canvas id="radarChart" width="400" height="400"></canvas>

    <!-- Script untuk inisialisasi Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Grafik untuk Performance Analysis
            const ctx = document.getElementById('dfChart').getContext('2d');
            const dataValues = [
                {{ $designFactor->input1df1 }},
                {{ $designFactor->input2df1 }},
                {{ $designFactor->input3df1 }},
                {{ $designFactor->input4df1 }}
            ];
            const labels = ['Strategy Archetype', 'Current Performance', 'Future Goals', 'Alignment with IT'];

            const dfChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Score',
                        data: dataValues,
                        backgroundColor: dataValues.map(value => value >= 0 ? 'rgba(54, 162, 235, 0.6)' : 'rgba(255, 99, 132, 0.6)'),
                        borderColor: dataValues.map(value => value >= 0 ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 99, 132, 1)'),
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            max: 5,
                            beginAtZero: true
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

            // Grafik untuk Relative Importance (Horizontal Bar Chart)
            const ctxRelativeImportance = document.getElementById('relativeImportanceChart').getContext('2d');
            const relativeImportanceValues = [
                {{ $designFactorRelativeImportance->r_df1_1 }},
                {{ $designFactorRelativeImportance->r_df1_2 }},
                {{ $designFactorRelativeImportance->r_df1_3 }},
                {{ $designFactorRelativeImportance->r_df1_4 }},
                {{ $designFactorRelativeImportance->r_df1_5 }},
                {{ $designFactorRelativeImportance->r_df1_6 }},
                {{ $designFactorRelativeImportance->r_df1_7 }},
                {{ $designFactorRelativeImportance->r_df1_8 }},
                {{ $designFactorRelativeImportance->r_df1_9 }},
                {{ $designFactorRelativeImportance->r_df1_10 }},
                {{ $designFactorRelativeImportance->r_df1_11 }},
                {{ $designFactorRelativeImportance->r_df1_12 }},
                {{ $designFactorRelativeImportance->r_df1_13 }},
                {{ $designFactorRelativeImportance->r_df1_14 }},
                {{ $designFactorRelativeImportance->r_df1_15 }},
                {{ $designFactorRelativeImportance->r_df1_16 }},
                {{ $designFactorRelativeImportance->r_df1_17 }},
                {{ $designFactorRelativeImportance->r_df1_18 }},
                {{ $designFactorRelativeImportance->r_df1_19 }},
                {{ $designFactorRelativeImportance->r_df1_20 }},
                {{ $designFactorRelativeImportance->r_df1_21 }},
                {{ $designFactorRelativeImportance->r_df1_22 }},
                {{ $designFactorRelativeImportance->r_df1_23 }},
                {{ $designFactorRelativeImportance->r_df1_24 }},
                {{ $designFactorRelativeImportance->r_df1_25 }},
                {{ $designFactorRelativeImportance->r_df1_26 }},
                {{ $designFactorRelativeImportance->r_df1_27 }},
                {{ $designFactorRelativeImportance->r_df1_28 }},
                {{ $designFactorRelativeImportance->r_df1_29 }},
                {{ $designFactorRelativeImportance->r_df1_30 }},
                {{ $designFactorRelativeImportance->r_df1_31 }},
                {{ $designFactorRelativeImportance->r_df1_32 }},
                {{ $designFactorRelativeImportance->r_df1_33 }},
                {{ $designFactorRelativeImportance->r_df1_34 }},
                {{ $designFactorRelativeImportance->r_df1_35 }},
                {{ $designFactorRelativeImportance->r_df1_36 }},
                {{ $designFactorRelativeImportance->r_df1_37 }},
                {{ $designFactorRelativeImportance->r_df1_38 }},
                {{ $designFactorRelativeImportance->r_df1_39 }},
                {{ $designFactorRelativeImportance->r_df1_40 }}
            ];
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

            const relativeImportanceChart = new Chart(ctxRelativeImportance, {
                type: 'bar',
                data: {
                    labels: relativeImportanceLabels,
                    datasets: [{
                        label: 'Relative Importance Score',
                        data: relativeImportanceValues,
                        backgroundColor: relativeImportanceValues.map(value => {
                            return value > 0 ? 'rgba(54, 162, 235, 0.6)' :
                                value < 0 ? 'rgba(255, 99, 132, 0.6)' :
                                    'rgba(201, 201, 201, 0.6)';
                        }),
                        borderColor: relativeImportanceValues.map(value => {
                            return value > 0 ? 'rgba(54, 162, 235, 1)' :
                                value < 0 ? 'rgba(255, 99, 132, 1)' :
                                    'rgba(201, 201, 201, 1)';
                        }),
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
                                    if (context.tick.value === 0) {
                                        return 'rgba(0, 0, 0, 0.3)';
                                    }
                                    return 'rgba(200, 200, 200, 0.3)';
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
            const ctxRadar = document.getElementById('radarChart').getContext('2d');

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
@endsection