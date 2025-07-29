// resources/views/objectives/show.blade.php

@php
  $guidanceByComponent = collect($objective['guidance'])
    ->groupBy(fn($g) => $g['pivot']['component']);
@endphp

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    {{-- Objective Selector Navigation --}}
    <div class="my-8 py-6">
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
    {{-- <div class="mb-6">
        <h1 class="text-3xl font-bold mb-2">{{ $objective['objective_id'] }} – {{ $objective['objective'] }}</h1>
        <p class="text-gray-700">{{ $objective['objective_description'] }}</p>
        <p class="text-gray-500 mt-1">{{ $objective['objective_purpose'] }}</p>
    </div> --}}
    <h1 class="text-3xl font-bold mb-4">Objective: {{ $objective->objective_id }} - {{ $objective->objective }}</h1>
     <div class="bg-white shadow rounded p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Description</h2>
        <p>{{ $objective->objective_description }}</p>
        <h2 class="text-xl font-semibold mt-4 mb-2">Purpose</h2>
        <p>{{ $objective->objective_purpose }}</p>
    </div>

    {{-- Domains --}}
    {{-- <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Domains</h2>
        <ul class="list-disc list-inside">
            @foreach($objective['domains'] as $dom)
                <li>{{ $dom['area'] }} ({{ trim($dom['pivot']['domain'], '"') }})</li>
            @endforeach
        </ul>
    </div> --}}

    <div class="mb-6">
        <h2 class="text-2xl font-semibold mb-2">Domains</h2>
        <ul class="list-disc pl-5">
            @foreach($objective->domains as $domain)
                <li>{{ $domain->area }} &mdash; {{ $domain->pivot->domain }}</li>
            @endforeach
        </ul>
    </div>

    {{-- Enterprise Goals --}}
    <div class="mb-6">
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
    <div class="mb-6">
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
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Practices</h2>
        @foreach($objective['practices'] as $pr)
            <div class="border p-4 rounded mb-4">
                <h3 class="font-medium mb-1">{{ trim($pr['practice_id'], '"') }}: {{ trim($pr['practice_name'], '"') }}</h3>
                <p class="text-gray-700 mb-2">{{ trim($pr['practice_description'], '"') }}</p>

                {{-- Guidance --}}
                {{-- <div class="mb-2">
                    <h4 class="font-semibold">Guidance</h4>
                    <ul class="list-disc list-inside ml-4">
                        @foreach($pr['guidances'] as $gd)
                            <li>{{ trim($gd['guidance'], '"') }} ({{ trim($gd['reference'], '"') }})</li>
                        @endforeach
                    </ul>
                </div> --}}

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
                {{-- <div class="mb-2">
                    <h4 class="font-semibold">Activities</h4>
                    <ul class="list-decimal list-inside ml-4">
                        @foreach($pr['activities'] as $ac)
                            <li>{{ trim($ac['description'], '"') }} (Level: {{ $ac['capability_lvl'] ?? '-' }})</li>
                        @endforeach
                    </ul>
                </div> --}}
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

                {{-- Info Flows --}}
                {{-- <div class="mb-2 grid grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-semibold">Inputs</h4>
                        <ul class="list-disc list-inside ml-4">
                            @foreach($pr['infoflowinput'] as $inp)
                                <li>
                                    <strong>{{ trim($inp['from'], '"') }}</strong>: {{ trim($inp['description'], '"') }}
                                    <ul class="list-disc list-inside ml-6">
                                        @foreach($inp['connectedoutputs'] as $co)
                                            <li>{{ trim($co['description'], '"') }} (To: {{ trim($co['to'], '"') }})</li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold">Outputs</h4>
                        <ul class="list-disc list-inside ml-4">
                            @foreach($pr['infoflowoutput'] as $out)
                                <li><strong>{{ trim($out['to'], '"') }}</strong>: {{ trim($out['description'], '"') }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}
            </div>
        @endforeach
    </div>

    {{-- Info Flows Table --}}
    <div class="mb-6">
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
    <div class="mb-6">
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

    {{-- <div class="overflow-x-auto my-8 py-6">
        <table class="min-w-full border-collapse border-2 border-gray-400 shadow-lg">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="border border-gray-300 p-2">Component: Organizational Structures</th>
                    <th class="border border-gray-300 p-2 text-left">Key Governance Practices</th>
                    <th class="border border-gray-300 p-2">Roles (R/A)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 p-2 font-semibold">Practices</td>
                    <td class="border border-gray-300 p-2">
                        <ul class="list-disc list-inside">
                            @if(isset($objective->practices) && $objective->practices)
                                @foreach($objective->practices as $practice)
                                    <li>{{ trim($practice->practice_id, '"') }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </td>
                    <td class="border border-gray-300 p-2">
                        @if(isset($objective->practices) && $objective->practices && $objective->practices->first() && isset($objective->practices->first()->roles))
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr>
                                        @foreach($objective->practices->first()->roles as $role)
                                            <th class="border border-gray-300 p-1 text-sm">{{ trim($role->role, '"') }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($objective->practices as $practice)
                                    <tr>
                                        @if(isset($practice->roles) && $practice->roles)
                                            @foreach($practice->roles as $role)
                                                <td class="border border-gray-300 p-1 text-center">{{ $role->pivot->r_a }}</td>
                                            @endforeach
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="text-gray-500">No roles available.</span>
                        @endif
                    </td>
                </tr>
                <tr class="bg-gray-100">
                    <td colspan="3" class="border border-gray-300 p-2 font-semibold">Related Guidance</td>
                </tr>
                <tr>
                    <td colspan="3" class="border border-gray-300 p-2">
                        <ul class="list-disc list-inside">
                            @if(isset($objective->guidance) && $objective->guidance)
                                @foreach($objective->guidance as $g)
                                    <li>{{ trim($g->guidance, '"') }} (Component: {{ $g->pivot->component }})</li>
                                @endforeach
                            @endif
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> --}}

    {{-- Policies --}}
    {{-- <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Policies</h2>
        @foreach($objective['policies'] as $po)
            <div class="border p-4 rounded mb-2">
                <h3 class="font-medium">{{ trim($po['policy'], '"') }}</h3>
                <p class="text-gray-700 mb-2">{{ trim($po['description'], '"') }}</p>
                <ul class="list-disc list-inside ml-4">
                    @foreach($po['guidances'] as $pg)
                        <li>{{ trim($pg['guidance'], '"') }} ({{ trim($pg['reference'], '"') }})</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div> --}}
    <div class="mb-6">
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
                        @foreach($po['guidances'] as $pg)
                            <div>{{ trim($pg['reference'], '"') }}</div>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Skills --}}
    {{-- <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Skills</h2>
        @foreach($objective['skill'] as $sk)
            <div class="border p-4 rounded mb-2">
                <h3 class="font-medium">{{ trim($sk['skill'], '"') }}</h3>
                @if(!empty($sk['guidances']))
                    <ul class="list-disc list-inside ml-4">
                        @foreach($sk['guidances'] as $sg)
                            <li>{{ trim($sg['guidance'], '"') }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No guidance</p>
                @endif
            </div>
        @endforeach
    </div> --}}
    <div class="mb-6">
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
                                <div>{{ trim($sg['reference'] ?? '', '"') }}</div>
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
    {{-- <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Culture, Ethics and Behavior</h2>
        @foreach($objective['keyculture'] as $kc)
            <div class="border p-4 rounded mb-2">
                <p>{{ trim($kc['element'], '"') }}</p>
                @if(!empty($kc['guidances']))
                    <ul class="list-disc list-inside ml-4">
                        @foreach($kc['guidances'] as $kg)
                            <li>{{ trim($kg['guidance'], '"') }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div> --}}

    <div class="mb-6">
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
                                <div>{{ trim($kg['pivot']['reference'] ?? '', '"') }}</div>
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
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Services, Infrastructure and Applications</h2>
        <ul class="list-disc list-inside ml-4">
            @foreach($objective['s_i_a'] as $sia)
                <li>{{ trim($sia['description'], '"') }}</li>
            @endforeach
        </ul>
    </div>

    {{-- Guidance Components --}}
    {{-- <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Guidance Components</h2>
        <ul class="list-disc list-inside ml-4">
            @foreach($objective['guidance'] as $g)
                <li>{{ trim($g['guidance'], '"') }} ({{ $g['pivot']['component'] }})</li>
            @endforeach
        </ul>
    </div> --}}
</div>
@endsection
