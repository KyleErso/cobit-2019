@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card Utama -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0 rounded">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Design Factor 2 - Enterprise Goals</h4>
                </div>
                <!-- Card Body -->
                <div class="card-body p-4">
                    <form action="{{ route('df2.store') }}" method="POST" id="df2Form">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        <!-- Tabel Assessment DF2 -->
                        @php
                            $inputs = [
                                'input1df2'  => ['EG01', 'Financial', 'Portfolio of competitive products and services'],
                                'input2df2'  => ['EG02', 'Financial', 'Managed business risk'],
                                'input3df2'  => ['EG03', 'Financial', 'Compliance with external laws and regulations'],
                                'input4df2'  => ['EG04', 'Financial', 'Quality of financial information'],
                                'input5df2'  => ['EG05', 'Customer', 'Customer-oriented service culture'],
                                'input6df2'  => ['EG06', 'Customer', 'Business-service continuity and availability'],
                                'input7df2'  => ['EG07', 'Customer', 'Quality of management information'],
                                'input8df2'  => ['EG08', 'Internal', 'Optimization of internal business process functionality'],
                                'input9df2'  => ['EG09', 'Internal', 'Optimization of business process costs'],
                                'input10df2' => ['EG10', 'Internal', 'Staff skills, motivation and productivity'],
                                'input11df2' => ['EG11', 'Internal', 'Compliance with internal policies'],
                                'input12df2' => ['EG12', 'Growth', 'Managed digital transformation programs'],
                                'input13df2' => ['EG13', 'Growth', 'Product and business innovation']
                            ];
                        @endphp

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Balanced Scorecard Dimension</th>
                                        <th scope="col">Enterprise Goal</th>
                                        <th scope="col">Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                                    <th class="text-center text-primary">DF2 Score</th>
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
    // DF2 Input Labels (menggunakan kode Enterprise Goal)
    const df2Labels = ['EG01', 'EG02', 'EG03', 'EG04', 'EG05', 'EG06', 'EG07', 'EG08', 'EG09', 'EG10', 'EG11', 'EG12', 'EG13'];
    const initialInputData = new Array(df2Labels.length).fill(3);

    // Bar Chart Input Assessment
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: df2Labels,
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
                y: { ticks: { font: { size: 12 } , autoSkip: false} }
            },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    });

    // Radar Chart Input Assessment
    const radarCtx = document.getElementById('radarChart').getContext('2d');
    const radarChart = new Chart(radarCtx, {
        type: 'radar',
        data: {
            labels: df2Labels,
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

    // Relative Importance Charts Setup
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
    
    // Relative Importance Bar Chart
    const relImpBarCtx = document.getElementById('relativeImportanceChart').getContext('2d');
    const relativeImportanceChart = new Chart(relImpBarCtx, {
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
            maintainAspectRatio: false,
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
                y: { ticks: { maxTicksLimit: 40, autoSkip: false } }
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
    });

    // Relative Importance Radar Chart
    const relImpRadarCtx = document.getElementById('relativeImportanceRadarChart').getContext('2d');
    const relativeImportanceRadarChart = new Chart(relImpRadarCtx, {
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
    });

    // DF2 Constants untuk perhitungan Relative Importance
    const DF2_MAP_1 = [
        [0, 0, 1, 0, 2, 2, 0, 2, 2, 0, 0, 0, 2],
        [1, 2, 0, 0, 0, 0, 2, 0, 0, 0, 1, 0, 0],
        [2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 1],
        [0, 0, 0, 2, 0, 0, 0, 0, 0, 2, 0, 0, 0],
        [0, 0, 1, 0, 1, 1, 0, 2, 1, 0, 0, 1, 0],
        [0, 1, 0, 0, 1, 0, 2, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 2, 0, 0, 0, 0, 0, 2, 0, 0, 0],
        [0, 0, 1, 0, 1, 1, 0, 1, 1, 0, 0, 0, 0],
        [0, 0, 1, 2, 0, 0, 0, 0, 1, 1, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 2, 0],
        [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0],
        [0, 0, 2, 0, 1, 1, 0, 2, 2, 0, 0, 0, 1],
        [0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 2]
    ];
    const DF2_MAP_2 = [
        [2, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 2, 1],
        [1, 0, 2, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1, 1, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 2, 1, 0, 1, 0, 1],
        [2, 2, 0, 1, 0, 2, 1, 1, 1, 2, 1, 1, 1, 0, 0, 1, 0, 0, 0, 2, 1, 1, 0, 2, 0, 0, 1, 0, 0, 2, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1],
        [0, 1, 0, 1, 0, 1, 1, 1, 0, 2, 0, 1, 2, 2, 2, 1, 0, 0, 0, 0, 2, 2, 2, 1, 1, 0, 0, 0, 1, 1, 2, 2, 2, 2, 1, 1, 2, 1, 0, 1],
        [0, 1, 0, 1, 0, 0, 1, 2, 2, 1, 0, 0, 2, 0, 1, 0, 0, 0, 0, 1, 2, 2, 0, 1, 2, 2, 1, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 2, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 2, 2, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 2, 0, 0, 1, 1, 2, 2, 1, 0, 1, 0, 1],
        [1, 1, 0, 1, 0, 1, 2, 2, 1, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0, 2, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 2, 0, 0, 0, 0],
        [0, 0, 0, 2, 0, 1, 0, 0, 0, 1, 2, 1, 1, 0, 1, 2, 0, 0, 0, 2, 2, 2, 1, 2, 0, 1, 1, 0, 0, 2, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0],
        [0, 0, 0, 0, 2, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 2, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1, 0, 1],
        [1, 0, 1, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 2, 1, 2],
        [0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 1, 0, 0, 0, 0, 1, 0, 2, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    ];
    const DF2_BASELINE_SCORE = [111, 117, 69, 138, 63, 183, 135, 138, 126, 141, 117, 114, 195, 63, 78, 132, 42, 45, 81, 129, 174, 165, 72, 183, 90, 69, 141, 51, 42, 138, 63, 57, 57, 69, 87, 108, 135, 138, 39, 114];
    const DF2_INPUT_BASELINE = [3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3];
    function calculateAndUpdate() {
  // Ambil nilai rating dari tiap input DF2
  const df2InputKeys = Object.keys(@json($inputs));
  const scores = df2InputKeys.map(name => {
    const selected = document.querySelector(`input[name="${name}"]:checked`);
    return selected ? parseFloat(selected.value) : 0;
  });

  // Update grafik Input Score
  barChart.data.datasets[0].data = scores;
  barChart.update();
  radarChart.data.datasets[0].data = scores;
  radarChart.update();

  // Hitung C26 = scores * DF2_MAP_1
  const C26 = new Array(DF2_MAP_1[0].length).fill(0);
  scores.forEach((score, i) => {
    DF2_MAP_1[i].forEach((val, j) => {
      C26[j] += score * val;
    });
  });

  // Hitung DF2_SCORE = C26 * DF2_MAP_2
  const DF2_SCORE = new Array(DF2_MAP_2[0].length).fill(0);
  C26.forEach((val, i) => {
    DF2_MAP_2[i].forEach((multiplier, j) => {
      DF2_SCORE[j] += val * multiplier;
    });
  });

  // Hitung rata-rata input saat ini dan baseline
  const DF2_INPUT_AVERAGE = scores.reduce((sum, val) => sum + val, 0) / scores.length;
  const average_DF2_INPUT_BASELINE = DF2_INPUT_BASELINE.reduce((sum, val) => sum + val, 0) / DF2_INPUT_BASELINE.length;
  const DF2_RELATIVE = DF2_INPUT_AVERAGE !== 0 ? average_DF2_INPUT_BASELINE / DF2_INPUT_AVERAGE : 0;

  const RelativeImp = DF2_SCORE.map((score, index) => {
  const baseline = DF2_BASELINE_SCORE[index];
  if (baseline === 0) return 0;
  const computed = Math.round((DF2_RELATIVE * 100 * score / baseline) / 5) * 5 - 100;
  return computed === -100 ? 0 : computed;
});

  // Update grafik Relative Importance (Bar Chart)
  relativeImportanceChart.data.datasets[0].data = RelativeImp;
  relativeImportanceChart.data.datasets[0].backgroundColor = RelativeImp.map(val =>
    val > 0 ? 'rgba(54, 162, 235, 0.6)' :
    val < 0 ? 'rgba(255, 99, 132, 0.6)' :
    'rgba(201, 201, 201, 0.6)'
  );
  relativeImportanceChart.data.datasets[0].borderColor = RelativeImp.map(val =>
    val > 0 ? 'rgba(54, 162, 235, 1)' :
    val < 0 ? 'rgba(255, 99, 132, 1)' :
    'rgba(201, 201, 201, 1)'
  );
  relativeImportanceChart.update();

  // Update grafik Relative Importance (Radar Chart)
  relativeImportanceRadarChart.data.datasets[0].data = RelativeImp;
  relativeImportanceRadarChart.data.datasets[0].borderColor = RelativeImp.map(val =>
    val < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
  );
  relativeImportanceRadarChart.data.datasets[0].pointBackgroundColor = RelativeImp.map(val =>
    val < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
  );
  relativeImportanceRadarChart.update();

  // Update tabel Relative Importance
  const tbody = document.querySelector('#results-table tbody');
  tbody.innerHTML = '';
  RelativeImp.forEach((val, index) => {
    const row = document.createElement('tr');
    const scoreClass = val > 0 
      ? 'bg-primary-subtle text-dark' 
      : val < 0 
      ? 'bg-danger-subtle text-dark' 
      : '';
    row.innerHTML = `
      <td class="text-center">${index + 1}</td>
      <td class="text-center">${DF2_SCORE[index].toFixed(2)}</td>
      <td class="text-center ${scoreClass}">${val}</td>
    `;
    tbody.appendChild(row);
  });
}

    // Pasang event listener untuk setiap perubahan pada radio button
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', calculateAndUpdate);
    });

    // Panggil perhitungan awal saat halaman dimuat
    calculateAndUpdate();
});
</script>
@endsection
