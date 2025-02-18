@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card Utama -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0 rounded">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Design Factor 1</h4>
                </div>
                <!-- Card Body -->
                <div class="card-body p-4">
                    <form action="{{ route('df1.store') }}" method="POST" id="df1Form">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        <!-- Tabel Assessment -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Strategy Archetype</th>
                                        <th scope="col">Explanation</th>
                                        <th scope="col">Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Gunakan key sesuai ID input yang diinginkan
                                        $inputs = [
                                            'strategy_archetype'  => ['SA01', 'Growth/Acquisition', 'The enterprise has a focus on growing (revenues).'],
                                            'current_performance' => ['SA02', 'Innovation/Differentiation', 'The enterprise has a focus on offering different and/or innovative products and services to their clients.'],
                                            'future_goals'        => ['SA03', 'Cost Leadership', 'The enterprise has a focus on short-term cost minimization.'],
                                            'alignment_with_it'   => ['SA04', 'Client Service/Stability', 'The enterprise has a focus on providing stable and client-oriented service.']
                                        ];
                                    @endphp

                                    @foreach($inputs as $name => $data)
                                        <tr>
                                            <td class="text-primary fw-bold">{{ $data[0] }}</td>
                                            <td>{{ $data[1] }}</td>
                                            <td>{{ $data[2] }}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" 
                                                                   name="{{ $name }}" id="{{ $name }}_{{ $i }}" 
                                                                   value="{{ $i }}" required>
                                                            <label class="form-check-label small" for="{{ $name }}_{{ $i }}">
                                                                {{ $i }}
                                                            </label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Grafik Input Score -->
                        <div class="row mt-4">
                            <!-- Bar Chart Input Score -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-header text-center">Bar Chart Input Score</div>
                                    <div class="card-body">
                                        <div class="w-100" style="height: 200px;">
                                            <canvas id="barChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Radar Chart Input Score -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-header text-center">Radar Chart Input Score</div>
                                    <div class="card-body">
                                        <div class="w-100" style="height: 200px;">
                                            <canvas id="radarChart"></canvas>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Layout: Relative Importance -->
                        <div class="row mt-4">
                            <!-- Relative Importance Radar Chart -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-header text-center text-primary">
                                        Relative Importance (Radar Chart)
                                    </div>
                                    <div class="card-body">
                                        <div class="w-100" style="height: 400px;">
                                            <canvas id="relativeImportanceRadarChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Relative Importance Table -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-header text-center text-primary">
                                        Relative Importance Table
                                    </div>
                                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                        <table class="table table-bordered table-sm" id="results-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center text-primary">Index</th>
                                                    <th class="text-center text-primary">DF1 Score</th>
                                                    <th class="text-center text-primary">Relative Importance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data akan diisi oleh JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Relative Importance Bar Chart -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header text-center text-primary">
                                        Relative Importance (Bar Chart)
                                    </div>
                                    <div class="card-body">
                                        <div class="w-100" style="height: 700px;">
                                            <canvas id="relativeImportanceChart"></canvas>
                                        </div>
                                    </div>
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
    // Inisialisasi Chart untuk Input Score
    const inputLabels = [
        'Growth/Acquisition',
        'Innovation/Differentiation',
        'Cost Leadership',
        'Client Service/Stability'
    ];
    const initialInputData = [0, 0, 0, 0];

    // Bar Chart Input Score
    const barChart = new Chart(document.getElementById('barChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: inputLabels,
            datasets: [{
                label: 'Scores',
                data: initialInputData,
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
                x: { max: 5, display: false },
                y: { ticks: { font: { size: 12 } } }
            },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    });

    // Radar Chart Input Score
    const radarChartMain = new Chart(document.getElementById('radarChart').getContext('2d'), {
        type: 'radar',
        data: {
            labels: inputLabels,
            datasets: [{
                label: 'Score Profile',
                data: initialInputData,
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
                    ticks: { stepSize: 1, display: false },
                    pointLabels: { font: { size: 12 } }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    });

    // Inisialisasi Chart untuk Relative Importance
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
    const initialRelativeData = new Array(40).fill(0);

    // Radar Chart Relative Importance
    const relativeImportanceRadarChart = new Chart(
        document.getElementById('relativeImportanceRadarChart').getContext('2d'),
        {
            type: 'radar',
            data: {
                labels: relativeImportanceLabels,
                datasets: [{
                    label: 'Relative Importance',
                    data: initialRelativeData,
                    backgroundColor: 'rgba(235, 54, 54, 0.2)',
                    borderColor: initialRelativeData.map(val =>
                        val < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
                    ),
                    borderWidth: 2,
                    pointBackgroundColor: initialRelativeData.map(val =>
                        val < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
                    ),
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: initialRelativeData.map(val =>
                        val < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
                    ),
                    borderJoinStyle: 'round',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
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
        }
    );

    // Bar Chart Relative Importance
const relativeImportanceChart = new Chart(
    document.getElementById('relativeImportanceChart').getContext('2d'),
    {
        type: 'bar',
        data: {
            labels: relativeImportanceLabels,
            datasets: [{
                label: 'Relative Importance Score',
                data: initialRelativeData,
                backgroundColor: initialRelativeData.map(val =>
                    val > 0 ? 'rgba(54, 162, 235, 0.6)' :
                    val < 0 ? 'rgba(255, 99, 132, 0.6)' :
                    'rgba(201, 201, 201, 0.6)'
                ),
                borderColor: initialRelativeData.map(val =>
                    val > 0 ? 'rgba(54, 162, 235, 1)' :
                    val < 0 ? 'rgba(255, 99, 132, 1)' :
                    'rgba(201, 201, 201, 1)'
                )
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false, // Agar chart mengikuti ukuran container
            scales: {
                x: {
                    max: 100,
                    min: -100,
                    beginAtZero: true,
                    ticks: { stepSize: 20 },
                    grid: {
                        color: ctx =>
                            ctx.tick.value === 0 ? 'rgba(0, 0, 0, 0.3)' : 'rgba(200, 200, 200, 0.3)',
                        lineWidth: ctx =>
                            ctx.tick.value === 0 ? 2 : 1
                    }
                },
                y: {
                    ticks: { maxTicksLimit: 40, autoSkip: false }
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
            }
        }
    }
);

    // Data Konstan Perhitungan
    const DF1_BASELINE = [3, 3, 3, 3];
    const DF1_BASELINE_SCORE = [
        15, 24, 15, 22.5, 18, 12, 28.5, 24, 21, 33,
        22.5, 15, 21, 22.5, 21, 21, 18, 16.5, 12, 27,
        13.5, 13.5, 18, 25.5, 19.5, 18, 19.5, 12, 12, 27,
        13.5, 21, 18, 21, 16.5, 13.5, 12, 12, 12, 12
    ];
    const DF1map = [
        [1.0, 1.0, 1.5, 1.5],
        [1.5, 1.0, 2.0, 3.5],
        [1.0, 1.0, 1.0, 2.0],
        [1.5, 1.0, 4.0, 1.0],
        [1.5, 1.5, 1.0, 2.0],
        [1.0, 1.0, 1.0, 1.0],
        [3.5, 3.5, 1.5, 1.0],
        [4.0, 2.0, 1.0, 1.0],
        [1.0, 4.0, 1.0, 1.0],
        [3.5, 4.0, 2.5, 1.0],
        [1.5, 1.0, 4.0, 1.0],
        [2.0, 1.0, 1.0, 1.0],
        [1.0, 1.5, 1.0, 3.5],
        [1.0, 1.0, 1.5, 4.0],
        [1.0, 1.0, 3.5, 1.5],
        [1.0, 1.0, 1.0, 4.0],
        [1.0, 1.5, 1.0, 2.5],
        [1.0, 1.0, 1.0, 2.5],
        [1.0, 1.0, 1.0, 1.0],
        [4.0, 2.0, 1.5, 1.5],
        [1.0, 1.0, 1.5, 1.0],
        [1.0, 1.0, 1.5, 1.0],
        [1.0, 1.0, 1.0, 3.0],
        [4.0, 2.0, 1.0, 1.5],
        [2.0, 2.0, 1.0, 1.5],
        [1.5, 2.0, 1.0, 1.5],
        [1.0, 3.5, 1.0, 1.0],
        [1.0, 1.0, 1.0, 1.0],
        [1.0, 1.0, 1.0, 1.0],
        [3.5, 3.0, 1.5, 1.0],
        [1.0, 1.0, 1.0, 1.5],
        [1.0, 1.0, 1.0, 4.0],
        [1.0, 1.0, 1.0, 3.0],
        [1.0, 1.0, 1.0, 4.0],
        [1.0, 1.0, 1.0, 2.5],
        [1.0, 1.0, 1.0, 1.5],
        [1.0, 1.0, 1.0, 1.0],
        [1.0, 1.0, 1.0, 1.0],
        [1.0, 1.0, 1.0, 1.0],
        [1.0, 1.0, 1.0, 1.0]
    ];

    // Fungsi Perhitungan dan Update Grafik
    function calculateAndUpdate() {
        // Ambil nilai input dari assessment (dengan name sesuai ID yang digunakan)
        const strategy = parseFloat(document.querySelector('input[name="strategy_archetype"]:checked')?.value || 0);
        const performance = parseFloat(document.querySelector('input[name="current_performance"]:checked')?.value || 0);
        const goals = parseFloat(document.querySelector('input[name="future_goals"]:checked')?.value || 0);
        const alignment = parseFloat(document.querySelector('input[name="alignment_with_it"]:checked')?.value || 0);
        const DF1_INPUT = [strategy, performance, goals, alignment];

        // Hitung E12 dan E14
        const E12 = DF1_INPUT.reduce((sum, val) => sum + val, 0) / DF1_INPUT.length;
        const average_E7_E10 = DF1_BASELINE.reduce((sum, val) => sum + val, 0) / DF1_BASELINE.length;
        const E14 = E12 !== 0 ? average_E7_E10 / E12 : 0;

        // Hitung DF1_SCORE
        const DF1_SCORE = DF1map.map(row =>
            row.reduce((sum, value, index) => sum + value * DF1_INPUT[index], 0)
        );

        // Hitung DF1_RELATIVE_IMPORTANCE dengan pembulatan
        const DF1_RELATIVE_IMPORTANCE = DF1_SCORE.map((b, index) => {
            const c = DF1_BASELINE_SCORE[index];
            return c !== 0 ? Math.round((E14 * 100 * b / c / 5)) * 5 - 100 : 0;
        });
// Update Tabel Relative Importance
const tbody = document.querySelector('#results-table tbody');
tbody.innerHTML = '';

DF1_SCORE.forEach((score, index) => {
    const row = document.createElement('tr');

    // Tentukan kelas warna berdasarkan nilai score
    let scoreClass = '';
    if (DF1_RELATIVE_IMPORTANCE[index] > 0) {
        scoreClass = 'bg-primary-subtle text-dark'; // Warna biru muda
    } else if (DF1_RELATIVE_IMPORTANCE[index] < 0) {
        scoreClass = 'bg-danger-subtle text-dark'; // Warna merah muda
    }
    row.innerHTML = `
        <td class="text-center">${index + 1}</td>
        <td class="text-center">${score.toFixed(2)}</td>
        <td class="text-center ${scoreClass}">${DF1_RELATIVE_IMPORTANCE[index]}</td>
    `;
    tbody.appendChild(row);
});


        // Update grafik Relative Importance (Bar)
        relativeImportanceChart.data.datasets[0].data = DF1_RELATIVE_IMPORTANCE.slice();
        relativeImportanceChart.data.datasets[0].backgroundColor = DF1_RELATIVE_IMPORTANCE.map(val =>
            val > 0 ? 'rgba(54, 162, 235, 0.6)' :
            val < 0 ? 'rgba(255, 99, 132, 0.6)' :
            'rgba(201, 201, 201, 0.6)'
        );
        relativeImportanceChart.data.datasets[0].borderColor = DF1_RELATIVE_IMPORTANCE.map(val =>
            val > 0 ? 'rgba(54, 162, 235, 1)' :
            val < 0 ? 'rgba(255, 99, 132, 1)' :
            'rgba(201, 201, 201, 1)'
        );
        relativeImportanceChart.update();

        // Update grafik Relative Importance (Radar)
        relativeImportanceRadarChart.data.datasets[0].data = DF1_RELATIVE_IMPORTANCE.slice();
        relativeImportanceRadarChart.data.datasets[0].borderColor = DF1_RELATIVE_IMPORTANCE.map(val =>
            val < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
        );
        relativeImportanceRadarChart.data.datasets[0].pointBackgroundColor = DF1_RELATIVE_IMPORTANCE.map(val =>
            val < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
        );
        relativeImportanceRadarChart.update();
    }

    // Event Listener untuk tiap radio button
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function () {
            const newData = [
                parseFloat(document.querySelector('input[name="strategy_archetype"]:checked')?.value || 0),
                parseFloat(document.querySelector('input[name="current_performance"]:checked')?.value || 0),
                parseFloat(document.querySelector('input[name="future_goals"]:checked')?.value || 0),
                parseFloat(document.querySelector('input[name="alignment_with_it"]:checked')?.value || 0)
            ];
            barChart.data.datasets[0].data = newData;
            barChart.update();
            radarChartMain.data.datasets[0].data = newData;
            radarChartMain.update();
            calculateAndUpdate();
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const radios = document.querySelectorAll('input[type="radio"]');
    
    function updateDisabledOptions() {
        let counts = { "4": 0, "5": 0 };

        radios.forEach(radio => {
            if (radio.checked) {
                if (radio.value === "4" || radio.value === "5") {
                    counts[radio.value]++;
                }
            }
        });

        radios.forEach(radio => {
            if (radio.value === "4" || radio.value === "5") {
                radio.disabled = counts[radio.value] >= 1 && !radio.checked;
            } else {
                const groupName = radio.name;
                const selectedCount = document.querySelectorAll(`input[name="${groupName}"]:checked`).length;
                radio.disabled = selectedCount >= 2 && !radio.checked;
            }
        });
    }

    radios.forEach(radio => radio.addEventListener("change", updateDisabledOptions));
});

</script>
@endsection
