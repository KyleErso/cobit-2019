@extends('cobit2019.cobitTools')

@section('cobit-tools-content')
  @include('cobit2019.cobitPagination')

  <div class="container my-4">
    <h3 class="mb-4">Step 3 Summary</h3>
    <p>
      Assessment ID: <strong>{{ $assessment->assessment_id }}</strong>
    </p>

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
        $weights = old('weight', [3,0,0,1,3,0,]);
    @endphp

    <div class="card shadow-sm mb-4">
      <div class="card-body p-3">
        <h5 class="mb-3">Relative Importance Matrix</h5>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-sm">
            <thead class="table-dark">
              <tr>
                <th>Design Factors</th>
                <th class="text-center bg-primary text-white">Threat Landscape</th>
                <th class="text-center bg-primary text-white">Compliance Req's</th>
                <th class="text-center bg-primary text-white">Role of IT</th>
                <th class="text-center bg-primary text-white">"Sourcing Model for IT"</th>
                <th class="text-center bg-primary text-white">IT Implementation Methods</th>
                <th class="text-center bg-primary text-white">Technology Adoption Strategy</th>
                <th class="text-center bg-secondary text-white">Refined Scope: Governance/
                Management Objectives Score</th>
              </tr>
              <tr class="bg-light">
                <th class="fw-bold">Weight</th>
                @for ($i = 0; $i < 6; $i++)
                  <th class="text-center">
                    <input
                      type="number"
                      name="weight[{{ $i+1 }}]"
                      value="{{ $weights[$i] }}"
                      class="form-control form-control-sm text-center p-0"
                      style="width: 60px; margin: auto;"
                    >
                  </th>
                @endfor
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($allCodes as $code)
                <tr>
                  <td class="fw-bold bg-primary-subtle text-dark">
                    {{ $cobitCodes[$code] ?? '' }}
                  </td>
                  @for ($n = 5; $n <= 10; $n++)
                    @php
                      $rec = $assessment->{'df'.$n.'RelativeImportances'}->firstWhere('id', auth()->id());
                      $col = "r_df{$n}_{$code}";
                      $val = ($rec && isset($rec->$col)) ? $rec->$col : 0;
                      // Tentukan background:
                      // Jika 0 → putih, jika negatif → merah subtle, jika positif → hijau subtle.
                      $cls = ($val == 0)
                        ? 'bg-white text-dark'
                        : ($val < 0 ? 'bg-danger-subtle text-dark' : 'bg-success-subtle text-dark');
                    @endphp
                    <td class="text-center p-1 {{ $cls }}">
                      {{ number_format($val, 0) }}
                    </td>
                  @endfor
                  <td class="text-center p-1 bg-secondary-emphasis text-dark">0</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- Placeholder untuk chart --}}
        <div class="mt-4">
          <h6 class="fs-6 mb-2">Chart: Some Chart Title</h6>
          <div id="chart-container" style="height:300px;">
            {{-- Nanti inject chart di sini --}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection