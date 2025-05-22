@extends('cobit2019.cobitTools')

@section('cobit-tools-content')
  @include('cobit2019.cobitPagination')
  <!-- Form untuk simpan sementara Step 3 -->
  <form action="{{ route('step3.store') }}" method="POST" id="step3Form">
    @csrf
    <input type="hidden" name="weights3" id="weights3Input">
    <input type="hidden" name="refinedScopes" id="refinedScopesInput">


    @if (session('success'))
    <div class="alert alert-success">
    {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger">
    {{ session('error') }}

  @endif

    <div class="container my-4">
      <div class="card shadow-sm mb-4">
      <!-- Ubah header card menjadi mirip step 2 -->
      <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0">Step 3 Summary :  Refine the scope of the Governance System</h5>
      </div>
      <div class="card-body">
        <div class="d-flex align-items-center mb-4">
        <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">

          <i class="fas fa-hashtag me-2"></i>
          Assessment ID: <strong>{{ $assessment->assessment_id }}</strong>
        </div>

        </div>

        @php
      use Illuminate\Support\Str;
      // 1) Kumpulkan semua kode Design Factor unik dari DF5–DF10 (menggunakan record pertama dari masing-masing relasi)
      $allCodes = collect();
      for ($n = 5; $n <= 10; $n++) {
      $ris = $assessment->{'df' . $n . 'RelativeImportances'}->first() ?? collect();
      foreach ($ris->toArray() as $col => $val) {
      if (Str::startsWith($col, "r_df{$n}_")) {
        $allCodes->push(Str::after($col, "r_df{$n}_"));
      }
      }
      }
      $allCodes = $allCodes->unique()->sort()->values();

      // Daftar lengkap kode COBIT 2019 untuk label
      $cobitCodes = [
      '',
      'EDM01',
      'EDM02',
      'EDM03',
      'EDM04',
      'EDM05',
      'APO01',
      'APO02',
      'APO03',
      'APO04',
      'APO05',
      'APO06',
      'APO07',
      'APO08',
      'APO09',
      'APO10',
      'APO11',
      'APO12',
      'APO13',
      'APO14',
      'BAI01',
      'BAI02',
      'BAI03',
      'BAI04',
      'BAI05',
      'BAI06',
      'BAI07',
      'BAI08',
      'BAI09',
      'BAI10',
      'BAI11',
      'DSS01',
      'DSS02',
      'DSS03',
      'DSS04',
      'DSS05',
      'DSS06',
      'MEA01',
      'MEA02',
      'MEA03',
      'MEA04'
      ];

      // 2) Berat masing-masing dimensi (bisa diisi user)
      // Ambil bobot terakhir dari session Step3, fallback ke nol
      $sessionWeights3 = session('step3.weights', []);
      $weights = old('weight', !empty($sessionWeights3) ? $sessionWeights3 : [0, 0, 0, 0, 0, 0])

    @endphp

        <div class="card shadow-sm mb-4">
        <!-- Ubah header tabel menjadi bg-primary dan text-white -->
        <div class="card-header text-primary py-3 bg-white">
          <h6 class="fw-bold mb-2">Relative Importance Matrix</h6>

          <button type="button" id="save3Button" class="btn btn-sm btn-secondary">
          Simpan Sementara
          </button>

        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
          <table class="table table-bordered table-hover table-sm mb-0" id="matrixTable">
            <thead>
            <tr>
              <th class="text-center bg-secondary fw-bold text-white" style="width: 120px;">Design Factors</th>
              <th class="text-center bg-primary text-white">Threat Landscape</th>
              <th class="text-center bg-primary text-white">Compliance Req's</th>
              <th class="text-center bg-primary text-white">Role of IT</th>
              <th class="text-center bg-primary text-white">"Sourcing Model for IT"</th>
              <th class="text-center bg-primary text-white">IT Implementation Methods</th>
              <th class="text-center bg-primary text-white">Technology Adoption Strategy</th>
              <th class="text-center bg-info text-white">Total</th>
              <th class="text-center bg-secondary text-white" style="width: 200px;">
              Refined Scope:<br>Governance/Management Objectives Score
              </th>
            </tr>
            <tr class="bg-success">
              <th class="fw-bold text-center text-white bg-warning">Weight</th>
              @for ($i = 0; $i < 6; $i++)
          <th class="text-center bg-success">
          <input type="number" name="weight[{{ $i + 1 }}]" value="{{ $weights[$i] }}"
          class="form-control form-control-sm text-center d-block mx-auto weight-input"
          style="width: 60px;" data-index="{{ $i }}">
          </th>
        @endfor
              <th class="text-center text-white">-</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($allCodes as $code)
            <tr>
            <td class="fw-bold bg-primary-subtle text-primary">
            {{ $cobitCodes[$code] ?? '' }}
            </td>
            @php
          $total = 0;
          $values = [];
          @endphp
            @for ($n = 5; $n <= 10; $n++)
            @php
          $rec = $assessment->{'df' . $n . 'RelativeImportances'}->firstWhere('id', auth()->id());
          $col = "r_df{$n}_{$code}";
          $val = ($rec && isset($rec->$col)) ? $rec->$col : 0;
          $values[] = $val;
          $cls = $val < 0 ? 'bg-danger bg-opacity-10' : ($val > 0 ? 'bg-success bg-opacity-10' : '');
          @endphp
            <td class="text-center {{ $cls }} fw-medium value-cell" data-value="{{ $val }}">
            {{ number_format($val, 0) }}
            </td>

          @endfor
            @php
          // Tambahkan array values baris ini
          $step3RelImps[] = $values;
          @endphp
            <td class="text-center bg-info bg-opacity-10 fw-bold total-cell">
            {{ number_format($total, 0) }}
            </td>
            <td class="text-center fw-medium refined-scope-cell">0</td>
            </tr>
        @endforeach
            </tbody>
          </table>
          </div>
        </div>
        </div>
        <p>
        @php
      // Ambil semua kode GMO (sama seperti allCodes tapi untuk DF1–10)
      $allCodes = collect();
      for ($n = 1; $n <= 10; $n++) {
      $ris = $assessment->{'df' . $n . 'RelativeImportances'}->first() ?? collect();
      foreach ($ris->toArray() as $col => $val) {
      if (Str::startsWith($col, "r_df{$n}_")) {
        $allCodes->push(Str::after($col, "r_df{$n}_"));
      }
      }
      }
      $allCodes = $allCodes->unique()->sort()->values();

      // Kumpulkan satu array per code, DF1–DF10
      $AllRelImps = [];
      foreach ($allCodes as $code) {
      $arr = [];
      for ($n = 1; $n <= 10; $n++) {
      $rec = $assessment->{'df' . $n . 'RelativeImportances'}->firstWhere('id', auth()->id());
      $col = "r_df{$n}_{$code}";
      $arr[] = ($rec && isset($rec->$col)) ? $rec->$col : 0;
      }
      $AllRelImps[$code] = $arr;
      }
    @endphp
        <!-- Chart Section (sama style dengan step 2) -->
        <div class="card shadow-sm">
        <div class="card-header bg-primary text-white py-3">
          <h6 class="mb-0 fw-bold">Chart: Refined Scope vs. Weights</h6>
        </div>
        <div id="chart-container" style="height:300px;">
          <canvas id="refinedScopeChart"></canvas>
        </div>

        </div>
      </div>
      </div>
    </div>
  </form>
  <!-- Styles tambahan (sama seperti di step 2) -->
  <style>
    .table {
    margin-bottom: 0;
    }

    .table th {
    border-top: none;
    font-weight: 600;
    vertical-align: middle;
    }

    .table td {
    vertical-align: middle;
    }

    .table input[type="number"] {
    -moz-appearance: textfield;
    }

    .table input[type="number"]::-webkit-outer-spin-button,
    .table input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    .table-hover tbody tr:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.05);
    }
  </style>

  <script>
    // 0) Ambil total Step 2 dari PHP (array indexed sesuai urutan `codes`)
    const step2Totals = @json($step2Totals); // e.g. [120, 85, 145, …]

    // 1) Ambil bobot Step 2 dari PHP
    const step2Weights = @json($step2Weights);          // e.g. [1,2,0,0]
    // 2) Ambil semua Relative Importances DF1–DF10 per code
    const allRelImps = @json($AllRelImps);              // { "EDM01":[…], "EDM02":[…], … }
    // 3) Urutan kode (sama dengan row di tabel)
    const codes = Object.keys(allRelImps);

    document.addEventListener('DOMContentLoaded', function () {
    const weightInputs = document.querySelectorAll('.weight-input');
    const rows = document.querySelectorAll('#matrixTable tbody tr');
    const outputBox = document.getElementById('weights-output');

    // helper: format angka tanpa desimal
    function number_format(num) {
      return new Intl.NumberFormat('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(num);
    }
    // helper: bulat ke kelipatan terdekat
    function roundToNearest(val, mul) {
      return Math.round(val / mul) * mul;
    }

    // baca bobot Step 3 saja (input user)
    function getStep3Weights() {
      return Array.from(weightInputs)
      .map(i => parseFloat(i.value) || 0);
    }

    // menghitung kontribusi Step 3 = Σ (RI5–10 * weightStep3)
    function calcStep3Total(code, weights3) {
      const rels = allRelImps[code].slice(4, 10); // indeks 4–9 = DF5–DF10
      return rels.reduce((sum, rel, i) => sum + rel * weights3[i], 0);
    }

  // update kolom Refined Scope per baris dengan vbar
function updateRefinedScope(total, maxTotal, row) {
  // hitung nilai refined scope (% dibulatkan 5 terdekat)
  let refined = 0;
  if (maxTotal !== 0) {
    const pct = Math.trunc((total / maxTotal) * 100);
    refined = total >= 0
      ? roundToNearest(pct, 5)
      : -roundToNearest(Math.abs(pct), 5);
  }

  // ambil sel
  const cell = row.querySelector('.refined-scope-cell');
  // kosongkan dulu
  cell.innerHTML = '';

  // container vbar
  const container = document.createElement('div');
  container.style.cssText = `
    position: relative;
    height: 20px;
    width: 180px;
    background: #f8f9fa;
    border: 1px solid #ddd;
    margin: 0 auto;
    overflow: hidden;
  `;

  // garis tengah baseline
  const centerLine = document.createElement('div');
  centerLine.style.cssText = `
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 1px;
    background: #aaa;
  `;
  container.appendChild(centerLine);

  // buat bar (kanan untuk positif, kiri untuk negatif)
  const bar = document.createElement('div');
  // barWidth: setengah skala (100 → 50%)
  const barWidth = Math.abs(refined) / 2;
  if (refined >= 0) {
    bar.style.cssText = `
      position: absolute;
      left: 50%;
      top: 0;
      height: 100%;
      width: ${barWidth}%;
      background-color: rgba(40, 167, 69, 0.8);
      transition: all 0.5s ease;
      max-width: 50%;
    `;
  } else {
    bar.style.cssText = `
      position: absolute;
      right: 50%;
      top: 0;
      height: 100%;
      width: ${barWidth}%;
      background-color: rgba(220, 53, 69, 0.8);
      transition: all 0.5s ease;
      max-width: 50%;
    `;
  }
  container.appendChild(bar);

  // label angka di tengah
  const label = document.createElement('div');
  label.style.cssText = `
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 500;
    color: #343a40;
    z-index: 1;
  `;
  label.textContent = number_format(refined);
  container.appendChild(label);

  // masukkan ke cell
  cell.appendChild(container);
  // simpan nilai refined sebagai data‑attribute (opsional)
  cell.setAttribute('data-scope', refined);
}


    // fungsi utama: hitung total = existing Step2 + kontribusi Step3
    function calculateRefinedScope() {
      const weights3 = getStep3Weights();

      // hitung total per code
      const totals = codes.map((code, idx) => {
      const tot2 = step2Totals[idx] || 0;               // Total dari Step 2
      const tot3 = calcStep3Total(code, weights3);      // Total Step 3
      return tot2 + tot3;
      });

      const maxTotal = Math.max(...totals) || 1;

      // render ke tabel
      totals.forEach((tot, idx) => {
      const row = rows[idx];
      row.querySelector('.total-cell').textContent = number_format(tot);
      updateRefinedScope(tot, maxTotal, row);
      });
    }

    // pas halaman siap & tiap input bobot berubah
    weightInputs.forEach(i => i.addEventListener('input', calculateRefinedScope));
    calculateRefinedScope();

    // simpan sementara
    document.getElementById('save3Button').addEventListener('click', () => {
      const w3 = getStep3Weights();
      const scopes = Array.from(rows).map(r => parseFloat(r.querySelector('.refined-scope-cell').textContent) || 0);
      document.getElementById('weights3Input').value = JSON.stringify(w3);
      document.getElementById('refinedScopesInput').value = JSON.stringify(scopes);
      document.getElementById('step3Form').submit();
    });

    });
  </script>

@endsection