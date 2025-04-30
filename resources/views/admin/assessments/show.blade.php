{{-- resources/views/admin/assessments/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h3 class="mb-4">Detail Assessment {{ $assessment->assessment_id }}</h3>
      <div class="row">
        <div class="col-md-6">
          <p class="mb-1"><strong>Kode:</strong> {{ $assessment->kode_assessment }}</p>
          <p><strong>Instansi:</strong> {{ $assessment->instansi }}</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Filter Controls --}}
  <div class="card mb-4">
    <div class="card-body">
      <div class="row g-3 align-items-center">
        <div class="col-md-4">
          <input type="number" id="filterUserId" class="form-control" placeholder="Masukkan User ID">
        </div>
        <div class="col-md-8">
          <button class="btn btn-primary me-2" id="applyFilter">Filter</button>
          <button class="btn btn-outline-secondary" id="clearFilter">Clear</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Toggle Buttons --}}
  <div class="btn-group mb-4 shadow-sm" role="group">
    <button type="button" class="btn btn-outline-primary" id="btn-df">Inputs</button>
    <button type="button" class="btn btn-outline-secondary" id="btn-scores">Scores</button>
    <button type="button" class="btn btn-outline-success" id="btn-relimp">RelImp</button>
    <button type="button" class="btn btn-outline-dark" id="btn-all">All</button>
  </div>

  @php
    $userIds = collect();
    for($n=1; $n<=10; $n++){
      $userIds = $userIds->merge($assessment->{'df'.$n}()->pluck('id'));
    }
    $userIds = $userIds->unique()->sort()->values();
  @endphp

  {{-- SECTION: Design Factor Inputs --}}
  <div id="section-df">
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h5 class="mb-3">Design Factor Inputs</h5>
        @for($n=1; $n<=10; $n++)
          <div class="mb-5">
            <h6 class="fw-bold mb-3">DF{{ $n }}</h6>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover table-sm">
                <thead class="table-primary">
                  <tr>
                    <th class="bg-primary text-white">Field \ User ID</th>
                    @foreach($userIds as $uid)
                      <th class="user-col col-u-{{ $uid }} text-center">{{ $uid }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @php
                    $dfRecord = $assessment->{'df'.$n}->first();
                    $inputs = $dfRecord 
                      ? collect($dfRecord->toArray())->filter(function($value, $key) use ($n) {
                          return str_starts_with($key, 'input') && str_ends_with($key, "df{$n}");
                        })->keys()
                      : collect();
                  @endphp
                  @foreach($inputs as $col)
                    <tr>
                      <td class="fw-bold">{{ str_replace("df{$n}", '', $col) }}</td>
                      @foreach($userIds as $uid)
                        @php $rec = $assessment->{'df'.$n}->firstWhere('id', $uid); @endphp
                        <td class="user-col col-u-{{ $uid }} text-center">{{ $rec ? $rec->$col : '-' }}</td>
                      @endforeach
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
      <div class="card-body">
        <h5 class="mb-3">Design Factor Scores</h5>
        @for($n=1; $n<=10; $n++)
          <div class="mb-5">
            <h6 class="fw-bold mb-3">DF{{ $n }}</h6>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover table-sm">
                <thead class="table-info">
                  <tr>
                    <th class="bg-info text-white">Score \ User ID</th>
                    @foreach($userIds as $uid)
                      <th class="user-col col-u-{{ $uid }} text-center">{{ $uid }}</th>
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
      <div class="card-body">
        <h5 class="mb-3">Relative Importance</h5>
        @for($n=1; $n<=10; $n++)
          <div class="mb-5">
            <h6 class="fw-bold mb-3">DF{{ $n }}</h6>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover table-sm">
                <thead class="table-success">
                  <tr>
                    <th class="bg-success text-white">RelImp \ User ID</th>
                    @foreach($userIds as $uid)
                      <th class="user-col col-u-{{ $uid }} text-center">{{ $uid }}</th>
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
    'btn-all': ['section-df', 'section-scores', 'section-relimp']
  };

  Object.entries(sections).forEach(([btnId, sectionIds]) => {
    document.getElementById(btnId).addEventListener('click', () => {
      document.querySelectorAll('[id^="section-"]').forEach(el => el.style.display = 'none');
      sectionIds.forEach(id => document.getElementById(id).style.display = 'block');
    });
  });

  // Filter columns
  const filterColumns = (userId) => {
    document.querySelectorAll('.user-col').forEach(el => {
      el.style.display = !userId || el.classList.contains(`col-u-${userId}`) ? '' : 'none';
    });
  };

  document.getElementById('applyFilter').addEventListener('click', () => {
    filterColumns(document.getElementById('filterUserId').value.trim());
  });

  document.getElementById('clearFilter').addEventListener('click', () => {
    document.getElementById('filterUserId').value = '';
    filterColumns('');
  });
</script>
@endsection