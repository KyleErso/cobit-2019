@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Main Card --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Detail Assessment {{ $assessment->assessment_id }}</h3>
                <a href="{{ route('admin.assessments.index') }}" class="btn btn-light px-3 py-2">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Kode:</strong> {{ $assessment->kode_assessment }}</p>
                    <p><strong>Instansi:</strong> {{ $assessment->instansi }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white py-3">
            <h6 class="m-0 font-weight-bold">Filter Data</h6>
        </div>
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <input type="number" id="filterUserId" class="form-control" placeholder="Masukkan User ID">
                </div>
                <div class="col-md-8">
                    <button class="btn btn-primary px-3 py-2 me-2" id="applyFilter">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    <button class="btn btn-outline-secondary px-3 py-2" id="clearFilter">
                        <i class="fas fa-sync me-2"></i>Clear
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Toggle Buttons --}}
    <div class="btn-group mb-4 shadow-sm w-100" role="group">
        <button type="button" class="btn btn-outline-primary px-3 py-2" id="btn-df">Inputs</button>
        <button type="button" class="btn btn-outline-secondary px-3 py-2" id="btn-scores">Scores</button>
        <button type="button" class="btn btn-outline-success px-3 py-2" id="btn-relimp">RelImp</button>
        <button type="button" class="btn btn-outline-dark px-3 py-2" id="btn-all">All</button>
    </div>

    @php
        use Illuminate\Support\Str;
        $userIds = collect();
        for($n=1; $n<=10; $n++){
            $userIds = $userIds->merge($assessment->{'df'.$n}()->pluck('id'));
        }
        $userIds = $userIds->unique()->sort()->values();
    @endphp

    {{-- SECTION: Design Factor Inputs --}}
    <div id="section-df">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0">Design Factor Inputs</h5>
            </div>
            <div class="card-body">
                @for($n=1; $n<=10; $n++)
                <div class="mb-5">
                    <h6 class="fw-bold mb-3">DF{{ $n }}</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm" data-df="{{ $n }}">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th style="width: 150px;">User</th>
                                    @foreach($userIds as $uid)
                                    <th class="user-col col-u-{{ $uid }} text-center" style="width: 120px;">
                                        <div class="fw-bold">{{ $uid }}</div>
                                        <small class="fw-normal">
                                            {{ explode(' ', $users[$uid] ?? 'Unknown')[0] }}
                                        </small>
                                    </th>
                                    @endforeach
                                    <th class="text-center bg-warning text-dark" style="width: 140px;">Suggestion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $dfRecords = $assessment->{'df'.$n};
                                    $inputCols = [];
                                    if ($first = $dfRecords->first()) {
                                        foreach ($first->getAttributes() as $key => $value) {
                                            if (Str::startsWith($key, 'input') && Str::endsWith($key, "df{$n}")) {
                                                $inputCols[] = $key;
                                            }
                                        }
                                    }
                                @endphp

                                @foreach($inputCols as $col)
                                <tr>
                                    <td class="fw-bold">{{ str_replace("df{$n}", '', $col) }}</td>
                                    @foreach($userIds as $uid)
                                        @php $rec = $dfRecords->firstWhere('id', $uid); @endphp
                                        <td class="user-col col-u-{{ $uid }} text-center">{{ $rec->{$col} ?? '-' }}</td>
                                    @endforeach
                                    {{-- placeholder for JS --}}
                                    <td class="suggestion text-center fw-bold">–</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>

    {{-- SECTION: Scores --}}
    <div id="section-scores" style="display:none;">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white py-3">
                <h5 class="mb-0">Design Factor Scores</h5>
            </div>
            <div class="card-body">
                @for($n=1; $n<=10; $n++)
                <div class="mb-5">
                    <h6 class="fw-bold mb-3">DF{{ $n }}</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                                <tr class="bg-info text-white">
                                    <th class="bg-info text-white" style="width: 150px;">User</th>
                                    @foreach($userIds as $uid)
                                    <th class="user-col col-u-{{ $uid }} text-center bg-info text-white" style="width: 120px;">
                                        <div class="fw-bold">{{ $uid }}</div>
                                        <small class="fw-normal">
                                            {{ explode(' ', $users[$uid] ?? 'Unknown')[0] }}
                                        </small>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php $scores = $assessment->{'df'.$n.'Scores'}->first() ?? collect(); @endphp
                                @foreach($scores->toArray() as $col => $val)
                                    @if(str_starts_with($col, 's_df'.$n.'_'))
                                    <tr>
                                        <td class="fw-bold">{{ $col }}</td>
                                        @foreach($userIds as $uid)
                                            @php $rec = $assessment->{'df'.$n.'Scores'}->firstWhere('id',$uid); @endphp
                                            <td class="user-col col-u-{{ $uid }} text-center">{{ $rec ? number_format($rec->$col, 2) : '-' }}</td>
                                        @endforeach
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>

    {{-- SECTION: Relative Importance --}}
    <div id="section-relimp" style="display:none;">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white py-3">
                <h5 class="mb-0">Relative Importance</h5>
            </div>
            <div class="card-body">
                @for($n=1; $n<=10; $n++)
                <div class="mb-5">
                    <h6 class="fw-bold mb-3">DF{{ $n }}</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                                <tr class="bg-success text-white">
                                    <th class="bg-success text-white" style="width: 150px;">User</th>
                                    @foreach($userIds as $uid)
                                    <th class="user-col col-u-{{ $uid }} text-center bg-success text-white" style="width: 120px;">
                                        <div class="fw-bold">{{ $uid }}</div>
                                        <small class="fw-normal">
                                            {{ explode(' ', $users[$uid] ?? 'Unknown')[0] }}
                                        </small>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php $ris = $assessment->{'df'.$n.'RelativeImportances'}->first() ?? collect(); @endphp
                                @foreach($ris->toArray() as $col => $val)
                                    @if(str_starts_with($col, 'r_df'.$n.'_'))
                                    <tr>
                                        <td class="fw-bold">{{ $col }}</td>
                                        @foreach($userIds as $uid)
                                            @php $rec = $assessment->{'df'.$n.'RelativeImportances'}->firstWhere('id',$uid); @endphp
                                            <td class="user-col col-u-{{ $uid }} text-center">{{ $rec ? number_format($rec->$col, 2) : '-' }}</td>
                                        @endforeach
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>


<script>
  // Toggle sections
  const sections = {
    'btn-df': ['section-df'],
    'btn-scores': ['section-scores'],
    'btn-relimp': ['section-relimp'],
    'btn-all': ['section-df','section-scores','section-relimp']
  };
  Object.entries(sections).forEach(([btn, secs]) => {
    document.getElementById(btn).addEventListener('click', () => {
      document.querySelectorAll('[id^="section-"]').forEach(el => el.style.display = 'none');
      secs.forEach(id => document.getElementById(id).style.display = 'block');
    });
  });

  // Filter columns
  function filterColumns(userId) {
    document.querySelectorAll('.user-col').forEach(el => {
      el.style.display = (!userId || el.classList.contains(`col-u-${userId}`)) ? '' : 'none';
    });
  }
  document.getElementById('applyFilter').addEventListener('click', () => {
    filterColumns(document.getElementById('filterUserId').value.trim());
  });
  document.getElementById('clearFilter').addEventListener('click', () => {
    document.getElementById('filterUserId').value = '';
    filterColumns('');
  });

  // Hitung suggestion via JS
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('#section-df table[data-df]').forEach(tbl => {
      const df = parseInt(tbl.dataset.df, 10);
      const isMode = [1,2,3,4,7].includes(df);

      tbl.querySelectorAll('tbody tr').forEach(row => {
        // Ambil text tiap user-col, skip '-' dan non-numeric
        const cells = Array.from(row.querySelectorAll('td'))
          .slice(1, -1)
          .map(td => td.textContent.trim())
          .filter(txt => txt !== '-');

        if (isMode) {
          const freq = {};
          cells.forEach(v => {
            // hanya numeric atau string angka
            if (!isNaN(v)) {
              v = String(v);
              freq[v] = (freq[v]||0) + 1;
            }
          });
          const max = Math.max(0, ...Object.values(freq));
          const modes = Object.entries(freq)
            .filter(([,c]) => c === max)
            .map(([v]) => v)
            .join(', ');
          row.querySelector('.suggestion').textContent = modes || '–';

        } else {
          // Rata2 persen: hanya hitung yang numeric
          const nums = cells
            .map(v=>parseFloat(v))
            .filter(v=>!isNaN(v));
          const avg = nums.length
            ? nums.reduce((a,b)=>a+b,0)/nums.length
            : 0;
          row.querySelector('.suggestion').textContent = avg.toFixed(2) + '%';
        }
      });
    });
  });
</script>
@endsection