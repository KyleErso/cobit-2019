@extends('cobit2019.cobitTools')

@section('cobit-tools-content')
  @include('cobit2019.cobitPagination')

  <div class="container my-4">
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0">Step 3 Summary</h5>
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
            $ris = $assessment->{'df'.$n.'RelativeImportances'}->first() ?? collect();
            foreach ($ris->toArray() as $col => $val) {
              if (Str::startsWith($col, "r_df{$n}_")) {
                $allCodes->push(Str::after($col, "r_df{$n}_"));
              }
            }
          }
          $allCodes = $allCodes->unique()->sort()->values();

          // Daftar lengkap kode COBIT 2019 untuk label
          $cobitCodes = [
            '','EDM01', 'EDM02', 'EDM03', 'EDM04', 'EDM05',
            'APO01', 'APO02', 'APO03', 'APO04', 'APO05', 'APO06', 'APO07', 'APO08', 'APO09', 'APO10', 'APO11', 'APO12', 'APO13', 'APO14',
            'BAI01', 'BAI02', 'BAI03', 'BAI04', 'BAI05', 'BAI06', 'BAI07', 'BAI08', 'BAI09', 'BAI10', 'BAI11',
            'DSS01', 'DSS02', 'DSS03', 'DSS04', 'DSS05', 'DSS06',
            'MEA01', 'MEA02', 'MEA03', 'MEA04'
          ];

          // 2) Berat masing-masing dimensi (bisa diisi user)
          $weights = old('weight', [0,0,0,0,0,0]);
        @endphp

        <div class="card shadow-sm mb-4">
          <div class="card-header bg-white py-3">
            <h6 class="mb-0 fw-bold text-primary">Relative Importance Matrix</h6>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-sm mb-0" id="matrixTable">
                <thead>
                  <tr>
                    <th class="bg-light fw-bold" style="width: 120px;">Design Factors</th>
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
                  <tr class="bg-light">
                    <th class="fw-bold">Weight</th>
                    @for ($i = 0; $i < 6; $i++)
                      <th class="text-center">
                        <input
                          type="number"
                          name="weight[{{ $i+1 }}]"
                          value="{{ $weights[$i] }}"
                          class="form-control form-control-sm text-center p-0 border-0 bg-transparent weight-input"
                          style="width: 60px; margin: auto;"
                          data-index="{{ $i }}"
                        >
                      </th>
                    @endfor
                    <th class="text-center">-</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allCodes as $code)
                    <tr>
                      <td class="fw-bold bg-light">
                        {{ $cobitCodes[$code] ?? '' }}
                      </td>
                      @php
                        $total = 0;
                        $values = [];
                      @endphp
                      @for ($n = 5; $n <= 10; $n++)
                        @php
                          $rec = $assessment->{'df'.$n.'RelativeImportances'}->firstWhere('id', auth()->id());
                          $col = "r_df{$n}_{$code}";
                          $val = ($rec && isset($rec->$col)) ? $rec->$col : 0;
                          $values[] = $val;
                          $total += $val;
                          $cls = $val < 0
                            ? 'bg-danger bg-opacity-10'
                            : ($val > 0
                               ? 'bg-success bg-opacity-10'
                               : '');
                        @endphp
                        <td class="text-center {{ $cls }} fw-medium value-cell" data-value="{{ $val }}">
                          {{ number_format($val, 0) }}
                        </td>
                      @endfor
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

        {{-- Chart Section --}}
        <div class="card shadow-sm">
          <div class="card-header bg-white py-3">
            <h6 class="mb-0 fw-bold text-primary">Chart: Initial Scope vs. Weights</h6>
          </div>
          <div class="card-body">
            <div id="chart-container" style="height:300px;">
              {{-- nanti inject chart di sini --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
    document.addEventListener('DOMContentLoaded', function() {
      const weightInputs = document.querySelectorAll('.weight-input');
      const rows = document.querySelectorAll('#matrixTable tbody tr');

      function calculateTotal(row) {
        const cells = row.querySelectorAll('.value-cell');
        const weights = Array.from(weightInputs).map(input => parseFloat(input.value) || 0);
        let total = 0;

        cells.forEach((cell, index) => {
          const value = parseFloat(cell.dataset.value) || 0;
          total += value * weights[index];
        });

        row.querySelector('.total-cell').textContent = number_format(total, 0);
        return total;
      }

      function calculateRefinedScope() {
        const totals = Array.from(rows).map(row => calculateTotal(row));
        const maxTotal = Math.max(...totals);

        rows.forEach((row, index) => {
          const total = totals[index];
          let refinedScope = 0;

          if (maxTotal !== 0) {
            const weightedSum = total;
            const percentage = (weightedSum / maxTotal) * 100;
            const truncated = Math.trunc(percentage);
            
            if (total >= 0) {
              refinedScope = Math.round(truncated / 5) * 5;
            } else {
              refinedScope = Math.round(truncated / 5) * -5;
            }
          }

          row.querySelector('.refined-scope-cell').textContent = number_format(refinedScope, 0);
        });
      }

      function number_format(number, decimals) {
        return new Intl.NumberFormat('en-US', {
          minimumFractionDigits: decimals,
          maximumFractionDigits: decimals
        }).format(number);
      }

      // Event listener untuk setiap input weight
      weightInputs.forEach(input => {
        input.addEventListener('input', function() {
          calculateRefinedScope();
        });
      });

      // Hitung total dan refined scope awal
      calculateRefinedScope();
    });
  </script>
@endsection