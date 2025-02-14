@extends('layouts.app')
@section('content')
<div class="container my-5">
    <!-- Card Utama -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Design Factor 1</h4>
                </div>
                <!-- Card Body -->
                <div class="card-body p-4">
                    <form action="{{ route('df1.store') }}" method="POST" id="df1Form">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">
                        
                        <!-- Assessment Items -->
                        @foreach([
                            'strategy_archetype' => 'Growth/Acquisition',
                            'current_performance' => 'Innovation/Differentiation',
                            'future_goals' => 'Cost Leadership',
                            'alignment_with_it' => 'Client Service/Stability'
                        ] as $name => $label)
                            <div class="assessment-item card mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <!-- Label -->
                                        <div class="col-md-4">
                                            <h6 class="mb-0 text-primary">{{ $label }}</h6>
                                        </div>
                                        <!-- Rating Options -->
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" 
                                                               name="{{ $name }}" id="{{ $name }}{{ $i }}" 
                                                               value="{{ $i }}" required>
                                                        <label class="form-check-label small" 
                                                               for="{{ $name }}{{ $i }}">{{ $i }}</label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Grafik Input Score -->
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-header text-center">
                                        Bar Chart Input Score
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="chart-container" style="height: 200px;">
                                            <canvas id="barChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-header text-center">
                                        Radar Chart Input Score
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="chart-container" style="height: 200px;">
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
                                        <div class="chart-container" style="height: 400px;">
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
                                    <div class="card-body p-3" style="max-height: 400px; overflow-y: auto;">
                                        <table class="table table-bordered table-sm" id="results-table">
                                            <thead class="thead-light">
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
                                        <div class="chart-container" style="height: 500px;">
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
    // ===============================
    // Inisialisasi Chart untuk Input Score
    // ===============================
    const inputLabels = [
        'Growth/Acquisition',
        'Innovation/Differentiation',
        'Cost Leadership',
        'Client Service/Stability'
    ];
    const initialInputData = [0, 0, 0, 0];

    // Bar Chart (Skor Input)
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

    // Radar Chart (Skor Input)
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

    // ===============================
    // Inisialisasi Chart untuk Relative Importance
    // ===============================
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
                        ticks: { stepSize: 25, backdropColor: 'transparent' },
                        pointLabels: { font: { size: 10 }, color: '#333' },
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
                maintainAspectRatio: true,
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

    // ===============================
    // Data Konstan Perhitungan
    // ===============================
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

    // ===============================
    // Fungsi Perhitungan dan Update Grafik
    // ===============================
    function calculateAndUpdate() {
        // Ambil nilai input
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

        // Update Tabel
        const tbody = document.querySelector('#results-table tbody');
        tbody.innerHTML = '';
        DF1_SCORE.forEach((score, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center">${index + 1}</td>
                <td class="text-center">${score.toFixed(2)}</td>
                <td class="text-center">${DF1_RELATIVE_IMPORTANCE[index]}</td>
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

    // ===============================
    // Event Listener untuk Input
    // ===============================
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function () {
            // Update grafik Input Score
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

            // Hitung ulang dan update tabel serta grafik Relative Importance
            calculateAndUpdate();
        });
    });
});
</script>

<!-- Custom CSS -->
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
    margin: auto;
    width: 100%;
}
.table-sm td, .table-sm th {
    padding: .3rem;
}
</style>
@endsection
