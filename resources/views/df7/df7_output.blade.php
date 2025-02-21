@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card Utama: Output Data Design Factor 6 -->
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow border-0 rounded">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Design Factor 7 Output</h4>
                </div>

                <!-- Card Body: Data Verifikasi -->
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>DF ID</th>
                                    <th>Support</th>
                                    <th>Factory</th>
                                    <th>Turnaround</th>
                                    <th>Strategic</th>
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
                    </div>
                </div>

                <!-- Card Body: Relative Importance Scores dan Chart -->
                <div class="card-body">
                    <div class="row">
                        <!-- Bagian Tabel Relative Importance Scores -->
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <!-- Header tabel dengan judul -->
                                <div class="card-header text-center text-primary">
                                    Relative Importance Scores
                                </div>
                                <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                                    <table class="table table-bordered table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center text-primary">Index</th>
                                                <th class="text-center text-primary">Label</th>
                                                <th class="text-center text-primary">Score</th>
                                                <th class="text-center text-primary">Relative Importance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                // Array label untuk tabel relative importance (40 label)
                                                $labels = [
                                                    'EDM01', 'EDM02', 'EDM03', 'EDM04', 'EDM05',
                                                    'APO01', 'APO02', 'APO03', 'APO04', 'APO05',
                                                    'APO06', 'APO07', 'APO08', 'APO09', 'APO10',
                                                    'APO11', 'APO12', 'APO13', 'APO14',
                                                    'BAI01', 'BAI02', 'BAI03', 'BAI04', 'BAI05', 'BAI06', 'BAI07', 'BAI08', 'BAI09', 'BAI10', 'BAI11',
                                                    'DSS01', 'DSS02', 'DSS03', 'DSS04', 'DSS05', 'DSS06',
                                                    'MEA01', 'MEA02', 'MEA03', 'MEA04'
                                                ];
                                            @endphp

                                            @foreach($labels as $index => $label)
                                                @php
                                                    // Mengambil nilai score dan relative importance dari data DF7
                                                    $score = $designFactor7->{'s_df7_' . ($index + 1)};
                                                    $relative = $designFactorRelativeImportance->{'r_df7_' . ($index + 1)};
                                                    // Menentukan kelas CSS berdasarkan nilai relative importance:
                                                    // - Positif: bg-primary-subtle
                                                    // - Negatif: bg-danger-subtle
                                                    // - Nol: tanpa kelas tambahan
                                                    $scoreClass = $relative > 0 ? 'bg-primary-subtle' : ($relative < 0 ? 'bg-danger-subtle' : '');
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td class="text-center">{{ $label }}</td>
                                                    <td class="text-center">{{ $score }}</td>
                                                    <td class="text-center {{ $scoreClass }}">{{ $relative }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian Chart: Relative Importance Bar Chart -->
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <!-- Header chart -->
                                <div class="card-header text-center text-primary">
                                    Relative Importance (Bar Chart)
                                </div>
                                <div class="card-body">
                                    <!-- Canvas untuk Chart.js Bar Chart -->
                                    <div class="w-100" style="height: 600px;">
                                        <canvas id="relativeImportanceBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Baris untuk Relative Importance Radar Chart -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card">
                                <!-- Header chart -->
                                <div class="card-header text-center text-primary">
                                    Relative Importance (Radar Chart)
                                </div>
                                <div class="card-body">
                                    <!-- Canvas untuk Chart.js Radar Chart -->
                                    <div class="w-100" style="height: 600px;">
                                        <canvas id="relativeImportanceRadarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Card Body -->
            </div>
        </div>
    </div>
</div>

<!-- Inisialisasi Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Data Relative Importance DF7, diambil dari controller
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

    // Label-label untuk Relative Importance 
    const relativeImportanceLabels = [
        'EDM01', 'EDM02', 'EDM03', 'EDM04', 'EDM05',
        'APO01', 'APO02', 'APO03', 'APO04', 'APO05',
        'APO06', 'APO07', 'APO08', 'APO09', 'APO10',
        'APO11', 'APO12', 'APO13', 'APO14',
        'BAI01', 'BAI02', 'BAI03', 'BAI04', 'BAI05', 'BAI06', 'BAI07', 'BAI08', 'BAI09', 'BAI10', 'BAI11',
        'DSS01', 'DSS02', 'DSS03', 'DSS04', 'DSS05', 'DSS06',
        'MEA01', 'MEA02', 'MEA03', 'MEA04'
    ];

    /* ------------------ Bar Chart Initialization ------------------ */
    const ctxBar = document.getElementById('relativeImportanceBarChart').getContext('2d');
    const barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: relativeImportanceLabels,
            datasets: [{
                label: 'Relative Importance Score',
                data: relativeImportanceValues,
                backgroundColor: relativeImportanceValues.map(value =>
                    value > 0 ? 'rgba(54, 162, 235, 0.6)' :
                    value < 0 ? 'rgba(255, 99, 132, 0.6)' :
                    'rgba(201, 201, 201, 0.6)'
                ),
                borderColor: relativeImportanceValues.map(value =>
                    value > 0 ? 'rgba(54, 162, 235, 1)' :
                    value < 0 ? 'rgba(255, 99, 132, 1)' :
                    'rgba(201, 201, 201, 1)'
                ),
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    max: 100,
                    min: -100,
                    beginAtZero: true,
                    ticks: { stepSize: 20 },
                    grid: {
                        color: ctx => ctx.tick.value === 0 ? 'rgba(0, 0, 0, 0.3)' : 'rgba(200, 200, 200, 0.3)',
                        lineWidth: ctx => ctx.tick.value === 0 ? 2 : 1
                    }
                },
                y: {
                    ticks: { autoSkip: false, maxTicksLimit: 40 }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => {
                            let label = ctx.dataset.label || '';
                            if (label) label += ': ';
                            label += ctx.raw >= 0 ? '+' + ctx.raw : ctx.raw;
                            return label;
                        }
                    }
                }
            }
        }
    });

    /* ------------------ Radar Chart Initialization ------------------ */
    // Membalik urutan label dan data khusus untuk Radar Chart,
    // sehingga urutannya akan mulai dari MEA04 ke EDM01 searah jarum jam.
    const reversedLabels = [...relativeImportanceLabels].reverse();
    const reversedValues = [...relativeImportanceValues].reverse();

    // Inisialisasi Radar Chart
    const ctxRadar = document.getElementById('relativeImportanceRadarChart').getContext('2d');
    const radarChart = new Chart(ctxRadar, {
        type: 'radar',
        data: {
            labels: reversedLabels,
            datasets: [{
                label: 'Relative Importance',
                data: reversedValues,
                backgroundColor: 'rgba(235, 54, 54, 0.2)',
                borderColor: reversedValues.map(value =>
                    value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
                ),
                borderWidth: 2,
                pointBackgroundColor: reversedValues.map(value =>
                    value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
                ),
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: reversedValues.map(value =>
                    value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
                ),
                tension: 0.4
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                r: {
                    suggestedMin: -100,
                    suggestedMax: 100,
                    ticks: { stepSize: 25 },
                    pointLabels: { font: { size: 10 } },
                    angleLines: { color: 'rgba(200, 200, 200, 0.3)' },
                    grid: { color: 'rgba(200, 200, 200, 0.3)' }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => {
                            let lbl = ctx.dataset.label || '';
                            if (lbl) lbl += ': ';
                            lbl += ctx.raw >= 0 ? '+' + ctx.raw : ctx.raw;
                            return lbl;
                        }
                    }
                }
            },
            elements: { line: { tension: 0.4 } }
        }
    });
});
</script>
@endsection
