// resources/views/objectives/show.blade.php

@php
  $guidanceByComponent = collect($objective['guidance'])
    ->groupBy(fn($g) => $g['pivot']['component']);
@endphp

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 mb-8">
    {{-- Objective Selector Navigation --}}
    <div class="my-8 py-6 mb-4">
        <label for="objectiveSelect" class="block text-sm font-medium text-gray-700">Select Objective</label>
        <select id="objectiveSelect" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            @if(isset($allObjectives) && $allObjectives)
                @foreach($allObjectives as $objNav)
                    <option value="{{ route('cobit2019.objectives.show', $objNav->objective_id) }}" {{ $objNav->objective_id === $objective->objective_id ? 'selected' : '' }}>
                        {{ $objNav->objective_id }} – {{ $objNav->objective }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
    <script>
        document.getElementById('objectiveSelect').addEventListener('change', function() {
            window.location.href = this.value;
        });
    </script>

    {{-- Objective Header --}}
    <h1 class="text-3xl font-bold mb-4">Objective: {{ $objective->objective_id }} - {{ $objective->objective }}</h1>
     <div class="bg-white shadow rounded p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Description</h2>
        <p>{{ $objective->objective_description }}</p>
        <h2 class="text-xl font-semibold mt-4 mb-2">Purpose</h2>
        <p>{{ $objective->objective_purpose }}</p>
        <h2 class="text-2xl font-semibold mb-2">Domains</h2>
        <ul class="list-disc pl-5">
            @foreach($objective->domains as $domain)
                <li>{{ $domain->area }} &mdash; {{ $domain->pivot->domain }}</li>
            @endforeach
        </ul>
    </div>

    {{-- Enterprise Goals --}}
    <div class="mt-4 mb-4">
        <h2 class="text-xl font-semibold mb-2">Enterprise Goals</h2>
        @foreach($objective['entergoals'] as $eg)
            <div class="border p-4 rounded mb-2">
                <h3 class="font-medium">{{ $eg['entergoals_id'] }}: {{ trim($eg['description'], '"') }}</h3>
                <ul class="list-disc list-inside ml-4 mt-1">
                    @foreach($eg['entergoalsmetr'] as $m)
                        <li>{{ trim($m['description'], '"') }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    {{-- Alignment Goals --}}
    <div class="mt-4 mb-4">
        <h2 class="text-xl font-semibold mb-2">Alignment Goals</h2>
        @foreach($objective['aligngoals'] as $ag)
            <div class="border p-4 rounded mb-2">
                <h3 class="font-medium">{{ $ag['aligngoals_id'] }}: {{ trim($ag['description'], '"') }}</h3>
                <ul class="list-disc list-inside ml-4 mt-1">
                    @foreach($ag['aligngoalsmetr'] as $m)
                        <li>{{ trim($m['description'], '"') }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    {{-- Practices --}}
    <div class="mt-4 mb-4">
        <h2 class="text-xl font-semibold mb-2">Practices</h2>
        @foreach($objective['practices'] as $pr)
            <div class="border p-4 rounded mb-4">
                <h3 class="font-medium mb-1">{{ trim($pr['practice_id'], '"') }}: {{ trim($pr['practice_name'], '"') }}</h3>
                <p class="text-gray-700 mb-2">{{ trim($pr['practice_description'], '"') }}</p>

                {{-- Practice Metrics --}}
                <div class="mb-2">
                    <h4 class="font-semibold mb-1">Practice Metrics</h4>
                    <table class="w-full border border-gray-300 border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 p-2 text-left">Metric Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pr['practicemetr'] as $pm)
                            <tr>
                                <td class="border border-gray-300 p-2">{{ trim($pm['description'], '"') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Activities --}}
                <div class="mb-2">
                    <h4 class="font-semibold mb-1">Activities</h4>
                    <table class="w-full border border-gray-300 border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 p-2 text-left">Activity</th>
                                <th class="border border-gray-300 p-2 text-left">Capability Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pr['activities'] as $ac)
                            <tr>
                                <td class="border border-gray-300 p-2">{{ trim($ac['description'], '"') }}</td>
                                <td class="border border-gray-300 p-2 text-center">{{ $ac['capability_lvl'] ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Guidance --}}
                <div class="mb-2">
                    <h4 class="font-semibold mb-1">Guidance</h4>
                    <table class="w-full border border-gray-300 border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 p-2 text-left">Guidance</th>
                                <th class="border border-gray-300 p-2 text-left">Reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pr['guidances'] as $gd)
                            <tr>
                                <td class="border border-gray-300 p-2">{{ trim($gd['guidance'], '"') }}</td>
                                <td class="border border-gray-300 p-2">{{ trim($gd['reference'], '"') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Info Flows Table --}}
    <div class="mt-4 mb-4">
        <h2 class="text-xl font-semibold mb-2">Information Flows</h2>
        <table class="w-full border border-gray-300 border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 p-2">Practice</th>
                    <th class="border border-gray-300 p-2">Input From</th>
                    <th class="border border-gray-300 p-2">Input Description</th>
                    <th class="border border-gray-300 p-2">Output Description</th>
                    <th class="border border-gray-300 p-2">Output To</th>
                </tr>
            </thead>
            <tbody>
                @foreach($objective['practices'] as $pr)
                    @php
                        $inputs = $pr['infoflowinput'];
                    @endphp
                    @foreach($inputs as $inp)
                        @php
                            $outs = collect($inp['connectedoutputs']);
                        @endphp
                        @foreach($outs as $co)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ trim($pr['practice_id'], '"') }}</td>
                            <td class="border border-gray-300 p-2">{{ trim($inp['from'], '"') }}</td>
                            <td class="border border-gray-300 p-2">{{ trim($inp['description'], '"') }}</td>
                            <td class="border border-gray-300 p-2">{{ trim($co['description'], '"') }}</td>
                            <td class="border border-gray-300 p-2">{{ trim($co['to'], '"') }}</td>
                        </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    @if(isset($guidanceByComponent['Infoflow']))
    <div class="mb-6">
    <h2 class="text-lg font-semibold mb-2">Guidance (Infoflow)</h2>
    <table class="w-full border border-gray-300 border-collapse">
        <thead class="bg-gray-100">
        <tr>
            <th class="border p-2">Guidance</th>
            <th class="border p-2">Reference</th>
        </tr>
        </thead>
        <tbody>
        @foreach($guidanceByComponent['Infoflow'] as $g)
        <tr>
            <td class="border p-2">{{ trim($g['guidance'], '"') }}</td>
            <td class="border p-2">{{ trim($g['reference'], '"') }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    @endif


    {{-- Component: Organizational Structures --}}
    {{-- Roles Matrix --}}
    <div class="mt-4 mb-4">
        <h2 class="text-xl font-semibold mb-2">Organizational Structures</h2>
        <table class="w-full border border-gray-300 border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 p-2">Practice</th>
                    @foreach($objective['practices'][0]['roles'] as $role)
                        <th class="border border-gray-300 p-2 text-left">{{ trim($role['role'], '"') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($objective['practices'] as $pr)
                <tr>
                    {{-- <td class="border border-gray-300 p-2">{{ trim($pr['practice_id'], '"') }}</td> --}}
                    <td class="border border-gray-300 p-2">
                        {{ trim($pr['practice_id'], '"') }} – {{ trim($pr['practice_name'], '"') }}
                    </td>
                    @foreach($pr['roles'] as $rl)
                        <td class="border border-gray-300 p-2 text-center">{{ $rl['pivot']['r_a'] }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(isset($guidanceByComponent['Organizational']))
    <div class="mb-6">
    <h2 class="text-lg font-semibold mb-2">Guidance (Organizational)</h2>
    <table class="w-full border border-gray-300 border-collapse">
        <thead class="bg-gray-100">
        <tr>
            <th class="border p-2">Guidance</th>
            <th class="border p-2">Reference</th>
        </tr>
        </thead>
        <tbody>
        @foreach($guidanceByComponent['Organizational'] as $g)
        <tr>
            <td class="border p-2">{{ trim($g['guidance'], '"') }}</td>
            <td class="border p-2">{{ trim($g['reference'], '"') }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    @endif

    {{-- Policies --}}
    <div class="mt-4 mb-4">
        <h2 class="text-xl font-semibold mb-2">Policies</h2>
        <table class="w-full border border-gray-300 border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 p-2">Policy</th>
                    <th class="border border-gray-300 p-2">Description</th>
                    <th class="border border-gray-300 p-2">Related Guidance</th>
                    <th class="border border-gray-300 p-2">Reference</th>
                </tr>
            </thead>
            <tbody>
                @foreach($objective['policies'] as $po)
                <tr>
                    <td class="border border-gray-300 p-2">{{ trim($po['policy'], '"') }}</td>
                    <td class="border border-gray-300 p-2">{{ trim($po['description'], '"') }}</td>
                    <td class="border border-gray-300 p-2">
                        <ul class="list-disc list-inside ml-4">
                            @foreach($po['guidances'] as $pg)
                                <li>{{ trim($pg['guidance'], '"') }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="border border-gray-300 p-2">
                        {{-- @foreach($po['guidances'] as $pg)
                            <li>{{ trim($pg['reference'], '"') }}</li>
                        @endforeach --}}
                        <ul class="list-disc list-inside ml-4">
                            @foreach($po['guidances'] as $pg)
                                <li>{{ trim($pg['reference'], '"') }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Skills --}}
    <div class="mt-4 mb-4">
        <h2 class="text-xl font-semibold mb-2">Skills</h2>
        <table class="w-full border border-gray-300 border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 p-2 text-left">Skill</th>
                    <th class="border border-gray-300 p-2 text-left">Guidance</th>
                    <th class="border border-gray-300 p-2 text-left">Reference</th>
                </tr>
            </thead>
            <tbody>
                @foreach($objective['skill'] as $sk)
                <tr>
                    <td class="border border-gray-300 p-2">{{ trim($sk['skill'], '"') }}</td>
                    <td class="border border-gray-300 p-2">
                        @if(!empty($sk['guidances']))
                            <ul class="list-disc list-inside ml-4">
                                @foreach($sk['guidances'] as $sg)
                                    <li>{{ trim($sg['guidance'], '"') }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 p-2">
                        @if(!empty($sk['guidances']))
                            @foreach($sk['guidances'] as $sg)
                                <li>{{ trim($sg['reference'] ?? '', '"') }}</li>
                            @endforeach
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Culture, Ethics and Behavior --}}
    <div class="mt-4 mb-4">
        <h2 class="text-xl font-semibold mb-2">Culture, Ethics and Behavior</h2>
        <table class="w-full border border-gray-300 border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 p-2 text-left">Key Culture Element</th>
                    <th class="border border-gray-300 p-2 text-left">Guidance</th>
                    <th class="border border-gray-300 p-2 text-left">Reference</th>
                </tr>
            </thead>
            <tbody>
                @foreach($objective['keyculture'] as $kc)
                <tr>
                    <td class="border border-gray-300 p-2">{{ trim($kc['element'], '"') }}</td>
                    <td class="border border-gray-300 p-2">
                        @if(!empty($kc['guidances']))
                            <ul class="list-disc list-inside ml-4">
                                @foreach($kc['guidances'] as $kg)
                                    <li>{{ trim($kg['guidance'], '"') }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 p-2">
                        @if(!empty($kc['guidances']))
                            @foreach($kc['guidances'] as $kg)
                                <li>{{ trim($kg['pivot']['reference'] ?? '', '"') }}</li>
                            @endforeach
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Services, Infrastructure and Applications --}}
    <div class="mt-4 mb-4">
        <h2 class="text-xl font-semibold mb-2">Services, Infrastructure and Applications</h2>
        <ul class="list-disc list-inside ml-4">
            @foreach($objective['s_i_a'] as $sia)
                <li>{{ trim($sia['description'], '"') }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
