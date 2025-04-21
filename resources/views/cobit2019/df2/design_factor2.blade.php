@extends('cobit2019.cobitTools')
@section('cobit-tools-content')
@include('cobit2019.cobitPagination')
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
        'input1df2' => ['EG01', 'Financial', 'Portfolio of competitive products and services'],
        'input2df2' => ['EG02', 'Financial', 'Managed business risk'],
        'input3df2' => ['EG03', 'Financial', 'Compliance with external laws and regulations'],
        'input4df2' => ['EG04', 'Financial', 'Quality of financial information'],
        'input5df2' => ['EG05', 'Customer', 'Customer-oriented service culture'],
        'input6df2' => ['EG06', 'Customer', 'Business-service continuity and availability'],
        'input7df2' => ['EG07', 'Customer', 'Quality of management information'],
        'input8df2' => ['EG08', 'Internal', 'Optimization of internal business process functionality'],
        'input9df2' => ['EG09', 'Internal', 'Optimization of business process costs'],
        'input10df2' => ['EG10', 'Internal', 'Staff skills, motivation and productivity'],
        'input11df2' => ['EG11', 'Internal', 'Compliance with internal policies'],
        'input12df2' => ['EG12', 'Growth', 'Managed digital transformation programs'],
        'input13df2' => ['EG13', 'Growth', 'Product and business innovation']
        ];
      @endphp
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
          <!-- Caption dengan Hint dalam bentuk point-point -->
          <caption class="small mb-0 caption-top">
            <ul class="list-unstyled mb-0">
            <li><strong>Skala 5:</strong> Pilih 3 - 5 goal perusahaan yang paling penting.</li>
            <li><strong>Skala 1–4:</strong> Pilih 8 - 10 goal perusahaan yang cukup penting.</li>
            </ul>
          </caption>
          <thead class="table-success">
            <tr>
            <th scope="col">Reference</th>
            <th scope="col">Balanced Scorecard Dimension</th>
            <th scope="col">Enterprise Goal</th>
            <th scope="col">
              <div class="d-flex align-items-center">
              <span>Importance</span>
              <div class="d-flex align-items-center ms-auto">
                <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="df2SuggestionSwitch">
                </div>
              </div>
              </div>
            </th>
            <th scope="col">Baseline</th>
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
        <input class="form-check-input" type="radio" name="{{ $name }}" id="{{ $name }}_{{ $i }}"
        value="{{ $i }}" required>
        <label class="form-check-label small" for="{{ $name }}_{{ $i }}">
        {{ $i }}
        </label>
        </div>
      @endfor
          </div>
        </td>

        <td class="text-center fw-bold text-success fs-5">
          3
          <input type="hidden" name="baseline_{{ $name }}" value="3">
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
    // Tunggu hingga dokumen selesai dimuat
    document.addEventListener('DOMContentLoaded', () => {
    /*** KONFIGURASI AWAL ***/
    // Label untuk assessment DF2 (menggunakan kode Enterprise Goal)
    const DF2_LABELS = [
      'EG01', 'EG02', 'EG03', 'EG04', 'EG05', 'EG06', 'EG07',
      'EG08', 'EG09', 'EG10', 'EG11', 'EG12', 'EG13'
    ];
    const INITIAL_DF2_SCORE = 3;
    const NUM_DF2_INPUTS = DF2_LABELS.length;
    const initialInputData = Array(NUM_DF2_INPUTS).fill(INITIAL_DF2_SCORE);

    // Label untuk Relative Importance (misalnya, kode dari EDM, APO, BAI, DSS, MEA)
    const RELATIVE_LABELS = [
      'EDM01', 'EDM02', 'EDM03', 'EDM04', 'EDM05',
      'APO01', 'APO02', 'APO03', 'APO04', 'APO05', 'APO06', 'APO07', 'APO08', 'APO09', 'APO10', 'APO11', 'APO12', 'APO13', 'APO14',
      'BAI01', 'BAI02', 'BAI03', 'BAI04', 'BAI05', 'BAI06', 'BAI07', 'BAI08', 'BAI09', 'BAI10', 'BAI11',
      'DSS01', 'DSS02', 'DSS03', 'DSS04', 'DSS05', 'DSS06',
      'MEA01', 'MEA02', 'MEA03', 'MEA04'
    ];
    const NUM_RELATIVE = RELATIVE_LABELS.length;
    const initialRelativeData = Array(NUM_RELATIVE).fill(0);

    // Matriks perhitungan dan baseline (DF2_MAP_1: 13x13, DF2_MAP_2: 13x40)
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
    // Baseline score untuk masing-masing relative importance (jumlah elemen: 40)
    const DF2_BASELINE_SCORE = [111, 117, 69, 138, 63, 183, 135, 138, 126, 141, 117, 114, 195, 63, 78, 132, 42, 45, 81, 129, 174, 165, 72, 183, 90, 69, 141, 51, 42, 138, 63, 57, 57, 69, 87, 108, 135, 138, 39, 114];
    // Baseline input untuk DF2 (semua dengan nilai 3)
    const DF2_INPUT_BASELINE = Array(NUM_DF2_INPUTS).fill(INITIAL_DF2_SCORE);

    /*** INISIALISASI CHARTS ***/
    // Chart untuk input assessment (Bar Chart dan Radar Chart)
    const barChart = createBarChart('barChart', DF2_LABELS, initialInputData);
    const radarChart = createRadarChart('radarChart', DF2_LABELS, initialInputData);

    // Chart untuk Relative Importance (Bar Chart dan Radar Chart)
    const relativeBarChart = createRelativeBarChart('relativeImportanceChart', RELATIVE_LABELS, initialRelativeData);
    const relativeRadarChart = createRelativeRadarChart('relativeImportanceRadarChart', RELATIVE_LABELS, initialRelativeData);

    /*** LOGIKA PERHITUNGAN & UPDATE ***/
    // Fungsi utama untuk menghitung dan mengupdate semua komponen berdasarkan input user
    function calculateAndUpdate() {
      // 1. Ambil nilai rating dari masing-masing input DF2
      const inputScores = getDF2InputScores();

      // 2. Update grafik input (Bar & Radar) dengan nilai baru
      updateChart(barChart, inputScores);
      updateChart(radarChart, inputScores);

      // 3. Hitung nilai perantara (df2TransitionScore) dengan mengalikan input dengan DF2_MAP_1
      const df2TransitionScore = computedf2TransitionScore(inputScores, DF2_MAP_1);

      // 4. Hitung DF2_SCORE dengan mengalikan df2TransitionScore dengan DF2_MAP_2
      const df2Scores = computeDF2Scores(df2TransitionScore, DF2_MAP_2);

      // 5. Hitung faktor relatif berdasarkan rata-rata input saat ini dan baseline input
      const inputAverage = average(inputScores);
      const baselineAverage = average(DF2_INPUT_BASELINE);
      const relativeFactor = inputAverage !== 0 ? baselineAverage / inputAverage : 0;

      // 6. Hitung Relative Importance untuk tiap elemen
      const relativeImportanceValues = df2Scores.map((score, index) => {
      const baseline = DF2_BASELINE_SCORE[index];
      if (baseline === 0) return 0;
      const computedValue = Math.round((relativeFactor * 100 * score / baseline) / 5) * 5 - 100;
      return computedValue === -100 ? 0 : computedValue;
      });

      // 7. Update grafik Relative Importance (Bar & Radar) dengan nilai baru
      updateRelativeBarChart(relativeBarChart, relativeImportanceValues);
      updateRelativeRadarChart(relativeRadarChart, relativeImportanceValues);

      // 8. Update tabel Relative Importance dengan data terbaru
      updateRelativeTable(df2Scores, relativeImportanceValues);
    }

    // Pasang event listener pada semua radio button agar setiap perubahan memicu perhitungan ulang
    document.querySelectorAll('input[type="radio"]').forEach(radio =>
      radio.addEventListener('change', calculateAndUpdate)
    );

    // Panggil perhitungan awal saat halaman dimuat
    calculateAndUpdate();

    /*** DEFINISI FUNGSI UTILITAS ***/

    // Ambil nilai input DF2 dari radio button dengan mengambil key dari data $inputs yang di-passing dari Blade
    function getDF2InputScores() {
      const df2InputKeys = Object.keys(@json($inputs));
      return df2InputKeys.map(name => {
      const selectedInput = document.querySelector(`input[name="${name}"]:checked`);
      return selectedInput ? parseFloat(selectedInput.value) : 0;
      });
    }

    // Hitung array df2TransitionScore: perkalian setiap input dengan koefisien di DF2_MAP_1
    function computedf2TransitionScore(scores, mapMatrix) {
      const numColumns = mapMatrix[0].length;
      const result = Array(numColumns).fill(0);
      scores.forEach((score, i) => {
      mapMatrix[i].forEach((multiplier, j) => {
        result[j] += score * multiplier;
      });
      });
      return result;
    }

    // Hitung DF2_SCORE: perkalian array df2TransitionScore dengan matriks DF2_MAP_2
    function computeDF2Scores(df2TransitionScore, mapMatrix) {
      const numScores = mapMatrix[0].length;
      const result = Array(numScores).fill(0);
      df2TransitionScore.forEach((value, i) => {
      mapMatrix[i].forEach((multiplier, j) => {
        result[j] += value * multiplier;
      });
      });
      return result;
    }

    // Hitung rata-rata dari sebuah array angka
    function average(numbers) {
      return numbers.length ? numbers.reduce((sum, num) => sum + num, 0) / numbers.length : 0;
    }

    // Update data chart (umum untuk Bar Chart dan Radar Chart)
    function updateChart(chartInstance, data) {
      chartInstance.data.datasets[0].data = data;
      chartInstance.update();
    }

    // Update Relative Importance Bar Chart dengan data baru dan atur warnanya berdasarkan nilai
    function updateRelativeBarChart(chartInstance, data) {
      chartInstance.data.datasets[0].data = data;
      chartInstance.data.datasets[0].backgroundColor = data.map(value =>
      value > 0 ? 'rgba(54, 162, 235, 0.6)' :
        value < 0 ? 'rgba(255, 99, 132, 0.6)' :
        'rgba(201, 201, 201, 0.6)'
      );
      chartInstance.data.datasets[0].borderColor = data.map(value =>
      value > 0 ? 'rgba(54, 162, 235, 1)' :
        value < 0 ? 'rgba(255, 99, 132, 1)' :
        'rgba(201, 201, 201, 1)'
      );
      chartInstance.update();
    }

    // Update Relative Importance Radar Chart dengan data baru dan perbarui warna titik dan garis
    function updateRelativeRadarChart(chartInstance, data) {
      chartInstance.data.datasets[0].data = data;
      chartInstance.data.datasets[0].borderColor = data.map(value =>
      value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
      );
      chartInstance.data.datasets[0].pointBackgroundColor = data.map(value =>
      value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
      );
      chartInstance.update();
    }

    // Update tabel Relative Importance dengan memasukkan nomor indeks, nilai DF2_SCORE, dan Relative Importance
    function updateRelativeTable(df2Scores, relativeImportanceValues) {
      const tableBody = document.querySelector('#results-table tbody');
      tableBody.innerHTML = ''; // Bersihkan isi tabel sebelumnya

      relativeImportanceValues.forEach((relativeValue, index) => {
      const row = document.createElement('tr');
      // Terapkan kelas styling berdasarkan nilai (positif, negatif atau nol)
      const scoreClass = relativeValue > 0
        ? 'bg-primary-subtle text-dark'
        : relativeValue < 0
        ? 'bg-danger-subtle text-dark'
        : '';
      row.innerHTML = `
      <td class="text-center">${index + 1}</td>
      <td class="text-center">${df2Scores[index].toFixed(2)}</td>
      <td class="text-center ${scoreClass}">${relativeValue}</td>
      `;
      tableBody.appendChild(row);
      });
    }

    /*** FUNGSI PEMBUATAN CHART MENGGUNAKAN CHART.JS ***/

    // Buat Bar Chart horizontal untuk input assessment
    function createBarChart(canvasId, labels, data) {
      const ctx = document.getElementById(canvasId).getContext('2d');
      return new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
        label: 'Scores',
        data: data,
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
          max: 5,
          display: false
        },
        y: {
          ticks: {
          font: { size: 12 },
          autoSkip: false
          }
        }
        },
        plugins: {
        legend: { display: false },
        tooltip: { enabled: false }
        }
      }
      });
    }

    // Buat Radar Chart untuk input assessment
    function createRadarChart(canvasId, labels, data) {
      const ctx = document.getElementById(canvasId).getContext('2d');
      return new Chart(ctx, {
      type: 'radar',
      data: {
        labels: labels,
        datasets: [{
        label: 'Score Profile',
        data: data,
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
          ticks: {
          stepSize: 1,
          display: false
          },
          pointLabels: {
          font: { size: 12 }
          }
        }
        },
        plugins: {
        legend: { display: false },
        tooltip: { enabled: false }
        }
      }
      });
    }

    // Buat Bar Chart horizontal untuk Relative Importance
    function createRelativeBarChart(canvasId, labels, data) {
      const ctx = document.getElementById(canvasId).getContext('2d');
      return new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
        label: 'Relative Importance Score',
        data: data,
        backgroundColor: data.map(value =>
          value > 0 ? 'rgba(54, 162, 235, 0.6)' :
          value < 0 ? 'rgba(255, 99, 132, 0.6)' :
            'rgba(201, 201, 201, 0.6)'
        ),
        borderColor: data.map(value =>
          value > 0 ? 'rgba(54, 162, 235, 1)' :
          value < 0 ? 'rgba(255, 99, 132, 1)' :
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
          color: ctx => ctx.tick.value === 0
            ? 'rgba(0, 0, 0, 0.3)'
            : 'rgba(200, 200, 200, 0.3)',
          lineWidth: ctx => ctx.tick.value === 0 ? 2 : 1
          }
        },
        y: { ticks: { maxTicksLimit: 40, autoSkip: false } }
        },
        plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
          label: ctx => {
            let labelText = ctx.dataset.label || '';
            if (labelText) labelText += ': ';
            labelText += ctx.raw >= 0 ? '+' + ctx.raw : ctx.raw;
            return labelText;
          }
          }
        }
        }
      }
      });
    }

    // Buat Radar Chart untuk Relative Importance
    function createRelativeRadarChart(canvasId, labels, data) {
      const ctx = document.getElementById(canvasId).getContext('2d');
      return new Chart(ctx, {
      type: 'radar',
      data: {
        labels: labels,
        datasets: [{
        label: 'Relative Importance',
        data: data,
        backgroundColor: 'rgba(235, 54, 54, 0.2)',
        borderColor: data.map(value =>
          value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
        ),
        borderWidth: 2,
        pointBackgroundColor: data.map(value =>
          value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
        ),
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: data.map(value =>
          value < 0 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
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
            let labelText = ctx.dataset.label || '';
            if (labelText) labelText += ': ';
            labelText += ctx.raw >= 0 ? '+' + ctx.raw : ctx.raw;
            return labelText;
          }
          }
        }
        },
        elements: { line: { tension: 0.4 } }
      }
      });
    }
    });

    // ================ fungsi untuk DF2 Suggestion Switch ==============
document.addEventListener("DOMContentLoaded", function () {
  // Select semua radio button dalam form DF2
  const radios = document.querySelectorAll('#df2Form input[type="radio"]');
  // Ambil elemen switch DF2 (pastikan ID-nya adalah df2SuggestionSwitch)
  const df2SuggestionSwitch = document.getElementById('df2SuggestionSwitch');
  // Ambil elemen caption hint di dalam tabel DF2 (pastikan tabel ada dalam form DF2)
  const captionDf2Hint = document.querySelector('#df2Form table caption');

  // Set switch default on
  df2SuggestionSwitch.checked = true;

  function updateDisabledOptionsDF2() {
    if (df2SuggestionSwitch.checked) {
      // Tampilkan caption hint saat switch aktif
      captionDf2Hint.style.display = '';
      
      // Hitung jumlah pilihan rating 5 dan pilihan rating 1-4 di seluruh form
      let count5 = 0;
      let count1to4 = 0;
      
      radios.forEach(radio => {
        if (radio.checked) {
          if (radio.value === "5") {
            count5++;
          } else {
            count1to4++;
          }
        }
      });
      
      // Terapkan logika disable:
      radios.forEach(radio => {
        if (radio.value === "5") {
          // Jika sudah ada 5 pilihan rating 5, disable radio lain dengan nilai 5 (kecuali yang sudah dipilih)
          radio.disabled = (count5 >= 5) && !radio.checked;
        } else {
          // Untuk nilai 1-4, jika sudah ada 10 pilihan, disable radio lain (kecuali yang sudah dipilih)
          radio.disabled = (count1to4 >= 10) && !radio.checked;
        }
      });
    } else {
      // Sembunyikan caption hint saat switch tidak aktif
      captionDf2Hint.style.display = 'none';
      // Pastikan semua radio aktif
      radios.forEach(radio => {
        radio.disabled = false;
      });
    }
  }

  // Pasang event listener untuk tiap radio button
  radios.forEach(radio => radio.addEventListener("change", updateDisabledOptionsDF2));

  // Pasang event listener untuk switch DF2
  df2SuggestionSwitch.addEventListener("change", function() {
    // Reset semua radio setiap kali switch berubah
    radios.forEach(radio => {
      radio.checked = false;
      radio.disabled = false;
    });
    updateDisabledOptionsDF2();
  });

  // Panggil updateDisabledOptionsDF2 saat halaman selesai dimuat
  updateDisabledOptionsDF2();
});
  </script>
@endsection