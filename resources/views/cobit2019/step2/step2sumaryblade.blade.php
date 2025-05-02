@extends('cobit2019.cobitTools')

@section('cobit-tools-content')
  @include('cobit2019.cobitPagination')

  <div class="container my-4">
    <h3 class="mb-4">Step 2 Summary</h3>
    <p>
      Assessment ID: <strong>{{ $assessment->assessment_id }}</strong>
    </p>

    @php
      use Illuminate\Support\Str;

      // 1) Kumpulkan semua kode Design Factor unik dari DF1–DF4
      $allCodes = collect();
      for ($n = 1; $n <= 4; $n++) {
        $ris = $assessment->{'df'.$n.'RelativeImportances'}->first() ?? collect();
        foreach ($ris->toArray() as $col => $val) {
          if (Str::startsWith($col, "r_df{$n}_")) {
            $allCodes->push(Str::after($col, "r_df{$n}_"));
          }
        }
      }
      $allCodes = $allCodes->unique()->sort()->values();

      // 2) Berat masing-masing dimensi (bisa diisi user)
      $weights = old('weight', [3,0,0,1]);
    @endphp

    <div class="card shadow-sm mb-4">
      <div class="card-body p-3">
        <h5 class="mb-3">Relative Importance Matrix</h5>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-sm">
            <thead class="table-dark">
              <tr>
                <th>Design Factors</th>
                <th class="text-center bg-primary text-white">Enterprise Strategy</th>
                <th class="text-center bg-primary text-white">Enterprise Goals</th>
                <th class="text-center bg-primary text-white">Risk Profile</th>
                <th class="text-center bg-primary text-white">IT-Related Issues</th>
                <th class="text-center bg-secondary text-white">
                  Initial Scope:<br>Governance/Management Objectives
                </th>
              </tr>
              <tr class="bg-light">
                <th class="fw-bold">Weight</th>
                @for ($i = 0; $i < 4; $i++)
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
                  <td class="fw-bold">{{ $code }} — {{ __("") /* tambahkan deskripsi di sini */ }}</td>
                  @for ($n = 1; $n <= 4; $n++)
                    @php
                      $rec = $assessment->{'df'.$n.'RelativeImportances'}->firstWhere('id', auth()->id());
                      $col = "r_df{$n}_{$code}";
                      $val = ($rec && isset($rec->$col)) ? $rec->$col : 0;
                      // tentukan warna: merah subtle untuk <0, hijau subtle untuk >0
                      $cls = $val < 0
                        ? 'bg-danger bg-opacity-25'
                        : ($val > 0
                           ? 'bg-success bg-opacity-25'
                           : '');
                    @endphp
                    <td class="text-center {{ $cls }}">
                      {{ number_format($val, 0) }}
                    </td>
                  @endfor
                  <td class="text-center">0</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- placeholder untuk chart --}}
        <div class="mt-4">
          <h6>Chart: Initial Scope vs. Weights</h6>
          <div id="chart-container" style="height:300px;">
            {{-- nanti inject chart di sini --}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
