{{-- resources/views/cobit2019/objectives/show.blade.php --}}
@extends('layouts.app')

@section('content')
@php
  $guidanceByComponent = collect($objective['guidance'])
    ->groupBy(fn($g) => $g['pivot']['component']);
@endphp

<div class="container p-3"
     x-data="{
       activeComponent: 'overview',
       searchQuery: '',
       init() {
         const hash = window.location.hash.substring(1);
         const valid = ['overview','goals','practices','infoflows','organizational','policies','skills','culture','services'];
         if (hash && valid.includes(hash)) {
           this.activeComponent = hash;
         } else {
           const comp = new URLSearchParams(window.location.search).get('component');
           if (comp && valid.includes(comp)) this.activeComponent = comp;
         }
         this.$watch('activeComponent', val => window.location.hash = val);
       },
       matches(text) {
         if (! this.searchQuery) return true;
         return text.toLowerCase().includes(this.searchQuery.toLowerCase());
       },
       highlight(text) {
         if (! this.searchQuery) return text;
         const re = new RegExp(`(${this.searchQuery.replace(/[-/\\^$*+?.()|[\]{}]/g,'\\$&')})`, 'gi');
         return text.replace(re, '<mark>$1</mark>');
       }
     }"
     x-init="init()"
     x-cloak
>

  {{-- Quick Search --}}
  <div class="mb-3">
    <input type="text"
           x-model="searchQuery"
           class="form-control"
           placeholder="Cari teks di semua tab..."
    >
  </div>

  {{-- Objective Selector --}}
  <div class="mb-4">
    <label for="objectiveSelect" class="form-label">Select Objective</label>
    <select id="objectiveSelect" class="form-select">
      @foreach($allObjectives as $objNav)
        <option value="{{ route('cobit2019.objectives.show', $objNav->objective_id) }}"
          {{ $objNav->objective_id === $objective->objective_id ? 'selected' : '' }}>
          {{ $objNav->objective_id }} – {{ $objNav->objective }}
        </option>
      @endforeach
    </select>
  </div>
  <script>
    document.getElementById('objectiveSelect')
      .addEventListener('change', function() {
        window.location.href = this.value;
      });
  </script>

  {{-- Header --}}
  <h1 class="h2 mb-4" x-html="highlight('Objective: {{ $objective->objective_id }} – {{ $objective->objective }}')"></h1>

  {{-- Tabs --}}
  <div class="card mb-4">
    <div class="card-header p-0">
      <div class="d-flex overflow-auto">
        <ul class="nav nav-tabs flex-nowrap">
          @foreach([
            'overview'=>'Overview','goals'=>'Goals','practices'=>'Practices',
            'infoflows'=>'Information Flows','organizational'=>'Organizational',
            'policies'=>'Policies','skills'=>'Skills','culture'=>'Culture & Ethics',
            'services'=>'Services'
          ] as $key=>$label)
            <li class="nav-item">
              <button class="nav-link"
                      :class="activeComponent === '{{ $key }}' ? 'active' : ''"
                      @click="activeComponent='{{ $key }}'">
                <span x-html="highlight('{{ $label }}')"></span>
              </button>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="card-body">

      {{-- Overview --}}
      <div x-show="activeComponent==='overview'" x-cloak class="mb-4">
        <h2 class="h4 mb-3">Description</h2>
        <p x-show="matches('{{ $objective->objective_description }}')"
           x-html="highlight(`{{ $objective->objective_description }}`)"></p>

        <h2 class="h4 mt-4 mb-3">Purpose</h2>
        <p x-show="matches('{{ $objective->objective_purpose }}')"
           x-html="highlight(`{{ $objective->objective_purpose }}`)"></p>

        <h2 class="h4 mt-4 mb-3">Domains</h2>
        <ul class="list-group">
          @foreach($objective->domains as $d)
            <li class="list-group-item"
                x-show="matches('{{ $d->area }}') || matches('{{ $d->pivot->domain }}')"
                x-html="highlight(`<strong>{{ $d->area }}:</strong> {{ $d->pivot->domain }}`)">
            </li>
          @endforeach
        </ul>
      </div>

      {{-- Goals --}}
      <div x-show="activeComponent==='goals'" x-cloak class="mb-4">
        <h2 class="h4 mb-3">Enterprise Goals</h2>
        <div class="row">
          @foreach($objective['entergoals'] as $eg)
            <div class="col-md-6 mb-3" x-show="matches('{{ $eg['description'] }}')">
              <div class="card h-100">
                <div class="card-body">
                  <h3 class="h5"
                      x-html="highlight(`{{ $eg['entergoals_id'] }}: {{ trim($eg['description'],'\"') }}`)"></h3>
                  <ul class="list-group list-group-flush mt-2">
                    @foreach($eg['entergoalsmetr'] as $m)
                      <li class="list-group-item" x-show="matches('{{ $m['description'] }}')"
                          x-html="highlight(`{{ trim($m['description'],'\"') }}`)"></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <h2 class="h4 mt-5 mb-3">Alignment Goals</h2>
        <div class="row">
          @foreach($objective['aligngoals'] as $ag)
            <div class="col-md-6 mb-3" x-show="matches('{{ $ag['description'] }}')">
              <div class="card h-100">
                <div class="card-body">
                  <h3 class="h5"
                      x-html="highlight(`{{ $ag['aligngoals_id'] }}: {{ trim($ag['description'],'\"') }}`)"></h3>
                  <ul class="list-group list-group-flush mt-2">
                    @foreach($ag['aligngoalsmetr'] as $m)
                      <li class="list-group-item" x-show="matches('{{ $m['description'] }}')"
                          x-html="highlight(`{{ trim($m['description'],'\"') }}`)"></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Practices --}}
      <div x-show="activeComponent==='practices'" x-cloak class="mb-4">
        <div class="accordion" id="practicesAccordion">
          @foreach($objective['practices'] as $i=>$pr)
            <div class="accordion-item" x-show="matches('{{ $pr['practice_name'] }}')">
              <h2 class="accordion-header" id="heading{{ $i }}">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}"
                        aria-expanded="false" aria-controls="collapse{{ $i }}">
                  <span x-html="highlight(`{{ trim($pr['practice_id'],'\"') }}: {{ trim($pr['practice_name'],'\"') }}`)"></span>
                </button>
              </h2>
              <div id="collapse{{ $i }}" class="accordion-collapse collapse"
                   data-bs-parent="#practicesAccordion">
                <div class="accordion-body">
                  <p x-html="highlight(`{{ trim($pr['practice_description'],'\"') }}`)"></p>

                  <h5 class="mt-3">Practice Metrics</h5>
                  <div class="table-responsive mb-3">
                    <table class="table table-bordered">
                      <thead class="table-light"><tr><th>Metric Description</th></tr></thead>
                      <tbody>
                        @foreach($pr['practicemetr'] as $pm)
                          <tr x-show="matches('{{ $pm['description'] }}')">
                            <td x-html="highlight(`{{ trim($pm['description'],'\"') }}`)"></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                  <h5>Activities</h5>
                  <div class="table-responsive mb-3">
                    <table class="table table-bordered">
                      <thead class="table-light">
                        <tr><th>Activity</th><th class="text-center">Capability Level</th></tr>
                      </thead>
                      <tbody>
                        @foreach($pr['activities'] as $ac)
                          <tr x-show="matches('{{ $ac['description'] }}')">
                            <td x-html="highlight(`{{ trim($ac['description'],'\"') }}`)"></td>
                            <td class="text-center">{{ $ac['capability_lvl'] ?? '-' }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                  <h5>Guidance</h5>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="table-light"><tr><th>Guidance</th><th>Reference</th></tr></thead>
                      <tbody>
                        @foreach($pr['guidances'] as $gd)
                          <tr x-show="matches('{{ $gd['guidance'] }}') || matches('{{ $gd['reference'] }}')">
                            <td x-html="highlight(`{{ trim($gd['guidance'],'\"') }}`)"></td>
                            <td x-html="highlight(`{{ trim($gd['reference'],'\"') }}`)"></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Information Flows --}}
      <div x-show="activeComponent==='infoflows'" x-cloak class="mb-4">
        <h2 class="h4 mb-3">Information Flows</h2>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-light">
              <tr>
                <th>Practice</th><th>Input From</th><th>Input Description</th>
                <th>Output Description</th><th>Output To</th>
              </tr>
            </thead>
            <tbody>
              @foreach($objective['practices'] as $pr)
                @foreach($pr['infoflowinput'] as $inp)
                  @foreach(collect($inp['connectedoutputs']) as $co)
                    <tr x-show="matches('{{ $inp['description'] }}') || matches('{{ $co['description'] }}')">
                      <td>{{ trim($pr['practice_id'],'\"') }}</td>
                      <td x-html="highlight(`{{ trim($inp['from'],'\"') }}`)"></td>
                      <td x-html="highlight(`{{ trim($inp['description'],'\"') }}`)"></td>
                      <td x-html="highlight(`{{ trim($co['description'],'\"') }}`)"></td>
                      <td x-html="highlight(`{{ trim($co['to'],'\"') }}`)"></td>
                    </tr>
                  @endforeach
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
        @if(isset($guidanceByComponent['Infoflow']))
          <h5 class="mt-3">Guidance (Infoflow)</h5>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="table-light"><tr><th>Guidance</th><th>Reference</th></tr></thead>
              <tbody>
                @foreach($guidanceByComponent['Infoflow'] as $g)
                  <tr x-show="matches('{{ $g['guidance'] }}') || matches('{{ $g['reference'] }}')">
                    <td x-html="highlight(`{{ trim($g['guidance'],'\"') }}`)"></td>
                    <td x-html="highlight(`{{ trim($g['reference'],'\"') }}`)"></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>

      {{-- Organizational --}}
      <div x-show="activeComponent==='organizational'" x-cloak class="mb-4">
        <h2 class="h4 mb-3">Organizational Structures</h2>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-light">
              <tr>
                <th>Practice</th>
                @foreach($objective['practices'][0]['roles'] as $role)
                  <th>{{ trim($role['role'],'\"') }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($objective['practices'] as $pr)
                <tr x-show="matches('{{ $pr['practice_id'] }}')">
                  <td>{{ trim($pr['practice_id'],'\"') }}</td>
                  @foreach($pr['roles'] as $rl)
                    <td class="text-center">{{ $rl['pivot']['r_a'] }}</td>
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @if(isset($guidanceByComponent['Organizational']))
          <h5 class="mt-3">Guidance (Organizational)</h5>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="table-light"><tr><th>Guidance</th><th>Reference</th></tr></thead>
              <tbody>
                @foreach($guidanceByComponent['Organizational'] as $g)
                  <tr x-show="matches('{{ $g['guidance'] }}') || matches('{{ $g['reference'] }}')">
                    <td x-html="highlight(`{{ trim($g['guidance'],'\"') }}`)"></td>
                    <td x-html="highlight(`{{ trim($g['reference'],'\"') }}`)"></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>

      {{-- Policies --}}
      <div x-show="activeComponent==='policies'" x-cloak class="mb-4">
        <h2 class="h4 mb-3">Policies</h2>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-light"><tr><th>Policy</th><th>Description</th><th>Related Guidance</th><th>Reference</th></tr></thead>
            <tbody>
              @foreach($objective['policies'] as $po)
                <tr x-show="matches('{{ $po['policy'] }}') || matches('{{ $po['description'] }}')">
                  <td x-html="highlight(`{{ trim($po['policy'],'\"') }}`)"></td>
                  <td x-html="highlight(`{{ trim($po['description'],'\"') }}`)"></td>
                  <td><ul class="ps-3 mb-0">
                    @foreach($po['guidances'] as $pg)
                      <li x-show="matches('{{ $pg['guidance'] }}')" x-html="highlight(`{{ trim($pg['guidance'],'\"') }}`)"></li>
                    @endforeach
                  </ul></td>
                  <td><ul class="ps-3 mb-0">
                    @foreach($po['guidances'] as $pg)
                      <li x-show="matches('{{ $pg['reference'] }}')" x-html="highlight(`{{ trim($pg['reference'],'\"') }}`)"></li>
                    @endforeach
                  </ul></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- Skills --}}
      <div x-show="activeComponent==='skills'" x-cloak class="mb-4">
        <h2 class="h4 mb-3">Skills</h2>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-light"><tr><th>Skill</th><th>Guidance</th><th>Reference</th></tr></thead>
            <tbody>
              @foreach($objective['skill'] as $sk)
                <tr x-show="matches('{{ $sk['skill'] }}')">
                  <td x-html="highlight(`{{ trim($sk['skill'],'\"') }}`)"></td>
                  <td><ul class="ps-3 mb-0">
                    @foreach($sk['guidances'] as $sg)
                      <li x-show="matches('{{ $sg['guidance'] }}')" x-html="highlight(`{{ trim($sg['guidance'],'\"') }}`)"></li>
                    @endforeach
                  </ul></td>
                  <td><ul class="ps-3 mb-0">
                    @foreach($sk['guidances'] as $sg)
                      <li x-show="matches('{{ $sg['reference'] }}')" x-html="highlight(`{{ trim($sg['reference'],'\"') }}`)"></li>
                    @endforeach
                  </ul></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- Culture --}}
      <div x-show="activeComponent==='culture'" x-cloak class="mb-4">
        <h2 class="h4 mb-3">Culture, Ethics and Behavior</h2>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-light"><tr><th>Element</th><th>Guidance</th><th>Reference</th></tr></thead>
            <tbody>
              @foreach($objective['keyculture'] as $kc)
                <tr x-show="matches('{{ $kc['element'] }}')">
                  <td x-html="highlight(`{{ trim($kc['element'],'\"') }}`)"></td>
                  <td><ul class="ps-3 mb-0">
                    @foreach($kc['guidances'] as $kg)
                      <li x-show="matches('{{ $kg['guidance'] }}')" x-html="highlight(`{{ trim($kg['guidance'],'\"') }}`)"></li>
                    @endforeach
                  </ul></td>
                  <td><ul class="ps-3 mb-0">
                    @foreach($kc['guidances'] as $kg)
                      <li x-show="matches('{{ $kg['reference'] }}')" x-html="highlight(`{{ trim($kg['reference'],'\"') }}`)"></li>
                    @endforeach
                  </ul></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- Services --}}
      <div x-show="activeComponent==='services'" x-cloak class="mb-4">
        <h2 class="h4 mb-3">Services, Infrastructure and Applications</h2>
        <ul class="list-group">
          @foreach($objective['s_i_a'] as $sia)
            <li class="list-group-item" x-show="matches('{{ $sia['description'] }}')"
                x-html="highlight(`{{ trim($sia['description'],'\"') }}`)"></li>
          @endforeach
        </ul>
      </div>

    </div>
  </div>
</div>

{{-- Alpine JS --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
