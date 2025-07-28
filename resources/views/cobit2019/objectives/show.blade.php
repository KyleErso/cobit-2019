// resources/views/objectives/show.blade.php
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 space-y-8 mt-8">
        {{-- Objective Selector Navigation --}}
        <div class="mb-4">
            <label for="objectiveSelect" class="block text-sm font-medium text-gray-700">Select Objective</label>
            <select id="objectiveSelect" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                @foreach($allObjectives as $objNav)
                    <option value="{{ route('cobit2019.objectives.show', $objNav->objective_id) }}" {{ $objNav->objective_id === $objective->objective_id ? 'selected' : '' }}>
                        {{ $objNav->objective_id }} – {{ $objNav->objective }}
                    </option>
                @endforeach
            </select>
        </div>
        <script>
            document.getElementById('objectiveSelect').addEventListener('change', function() {
                window.location.href = this.value;
            });
        </script>
    {{-- Header Table --}}
    <div class="overflow-x-auto mt-8 mb-8">
        <table class="min-w-full border border-gray-300 border-collapse"">
            <thead>
                <tr class="bg-red-700 text-black">
                    <th colspan="3" class="p-2 text-left">Domain: {{ $objective->domains->first()->pivot->domain ?? '-' }}</th>
                    <th class="border border-gray-300 border-r border-gray-300 p-2 text-left">Focus Area: COBIT Core Model</th>
                </tr>
                <tr class="bg-gray-200">
                    <th colspan="2" class="p-2 text-left">Governance Objective: {{ $objective->objective_id }} – {{ $objective->objective }}</th>
                    <th colspan="2" class="p-2"></th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr>
                    <td class="border border-gray-300 border-r p-2 font-semibold">Description</td>
                    <td colspan="3" class="border p-2">{{ $objective->objective_description }}</td>
                </tr>
                <tr>
                    <td class="border p-2 font-semibold">Purpose</td>
                    <td colspan="3" class="border p-2">{{ $objective->objective_purpose }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Enterprise & Alignment Goals --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="overflow-x-auto mt-8 mb-8">
            <table class="min-w-full border">
                <thead class="bg-gray-300">
                    <tr>
                        <th colspan="2" class="p-2 text-left">Enterprise Goals</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($objective->entergoals as $eg)
                    <tr class="border">
                        <td class="border border-gray-300 p-2 align-top font-semibold">{{ $eg->entergoals_id }}</td>
                        <td class="p-2">
                            <ul class="list-disc list-inside">
                                @foreach($eg->entergoalsmetr as $m)
                                    <li>{{ trim($m->description, '"') }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="p-2 text-gray-500">No enterprise goals.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="overflow-x-auto mt-8 mb-8">
            <table class="min-w-full border">
                <thead class="bg-gray-300">
                    <tr>
                        <th colspan="2" class="p-2 text-left">Alignment Goals</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($objective->aligngoals as $ag)
                    <tr class="border">
                        <td class="p-2 align-top font-semibold">{{ $ag->aligngoals_id }}</td>
                        <td class="p-2">
                            <ul class="list-disc list-inside">
                                @foreach($ag->aligngoalsmetr as $m)
                                    <li>{{ trim($m->description, '"') }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="p-2 text-gray-500">No alignment goals.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Component: Process (Practices) --}}
    @foreach($objective->practices as $practice)
    <div class="overflow-x-auto mt-8 mb-8">
        <table class="min-w-full border">
            <thead>
                <tr class="bg-blue-800 text-black">
                    <th class="p-2 text-left">Component: Process</th>
                    <th class="p-2 text-left" colspan="3">Governance Practice: {{ trim($practice->practice_id, '"') }} – {{ trim($practice->practice_name, '"') }}</th>
                </tr>
                <tr class="bg-pink-700 text-black">
                    <th class="p-2 text-left">Example Metrics</th>
                    <th class="p-2 text-left" colspan="3">
                        <ul class="list-disc list-inside">
                            @foreach($practice->practicemetr as $pm)
                                <li>{{ trim($pm->description, '"') }}</li>
                            @endforeach
                        </ul>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-2 font-semibold">Activities</td>
                    <td colspan="2" class="border p-2">
                        <ol class="list-decimal list-inside">
                            @foreach($practice->activities as $act)
                                <li>{{ trim($act->description, '"') }}</li>
                            @endforeach
                        </ol>
                    </td>
                    <td class="border p-2 text-center">{{ $practice->activities->last()->capability_lvl ?? '-' }}</td>
                </tr>
                <tr class="bg-gray-100">
                    <td colspan="4" class="border p-2 font-semibold">Related Guidance</td>
                </tr>
                <tr>
                    <td colspan="2" class="border p-2">
                        <ul class="list-disc list-inside">
                            @foreach($practice->guidances as $gd)
                                <li>{{ trim($gd->guidance, '"') }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td colspan="2" class="border p-2">
                        <ul class="list-disc list-inside">
                            @foreach($practice->guidances as $gd)
                                <li>{{ trim($gd->reference, '"') }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforeach

    {{-- Component: Organizational Structures --}}
    <div class="overflow-x-auto mt-8 mb-8">
        <table class="min-w-full border mt-8">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="border-r border-gray-300 p-2">Component: Organizational Structures</th>
                    <th class="p-2 text-left">Key Governance Practices</th>
                    <th class="p-2">Roles (R/A)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 border-r p-2 font-semibold">Practices</td>
                    <td class="border p-2">
                        <ul class="list-disc list-inside">
                            @foreach($objective->practices as $practice)
                                <li>{{ trim($practice->practice_id, '"') }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="border p-2">
                        <table class="w-full border border-gray-300">
                        {{-- <table class="w-full border border-gray-300 border-collapse" border-gray-300"> --}}
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
                                    @foreach($practice->roles as $role)
                                        <td class="border border-gray-300 p-1 text-center">{{ $role->pivot->r_a }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="bg-gray-100">
                    <td colspan="3" class="border p-2 font-semibold">Related Guidance</td>
                </tr>
                <tr>
                    <td colspan="3" class="border p-2">
                        <ul class="list-disc list-inside">
                            @foreach($objective->guidance as $g)
                                <li>{{ trim($g->guidance, '"') }} (Component: {{ $g->pivot->component }})</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Component: Information Flows and Items --}}
    <div class="overflow-x-auto mt-8 mb-8">
        <table class="min-w-full border mt-8">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="p-2">Component: Information Flows and Items</th>
                    <th class="p-2">Inputs</th>
                    <th class="p-2">Outputs</th>
                </tr>
            </thead>
            <tbody>
                @foreach($objective->practices as $practice)
                <tr>
                    <td class="border p-2 font-semibold">{{ trim($practice->practice_id, '"') }}</td>
                    <td class="border p-2">
                        <ul class="list-disc list-inside">
                            @foreach($practice->infoflowinput as $inp)
                                <li>
                                    <strong>{{ $inp->from }}:</strong> {{ trim($inp->description, '"') }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="border p-2">
                        <ul class="list-disc list-inside">
                            @foreach($practice->infoflowoutput as $out)
                                <li>
                                    <strong>{{ $out->to }}:</strong> {{ trim($out->description, '"') }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Component: People, Skills and Competencies --}}
    <div class="overflow-x-auto mt-8 mb-8">
        <table class="min-w-full border mt-8">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="p-2">Component: People, Skills and Competencies</th>
                    <th class="p-2">Related Guidance</th>
                    <th class="p-2">Detailed Reference</th>
                </tr>
            </thead>
            <tbody>
                @forelse($objective->skill as $sk)
                <tr>
                    <td class="border p-2">{{ trim($sk->skill, '"') }}</td>
                    <td class="border p-2">
                        @if($sk->guidances->count())
                            <ul class="list-disc list-inside">
                                @foreach($sk->guidances as $sg)
                                    <li>{{ trim($sg->guidance, '"') }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="border p-2">{{ $sk->guidances->first()->pivot->reference ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="p-2 text-gray-500">No skills available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Component: Principles, Policies and Procedures --}}
    <div class="overflow-x-auto mt-8 mb-8">
        <table class="min-w-full border mt-8">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="p-2">Component: Principles, Policies and Procedures</th>
                    <th class="p-2">Policy Description</th>
                    <th class="p-2">Related Guidance</th>
                    <th class="p-2">Detailed Reference</th>
                </tr>
            </thead>
            <tbody>
                @forelse($objective->policies as $policy)
                <tr>
                    <td class="border p-2">{{ trim($policy->policy, '"') }}</td>
                    <td class="border p-2">{{ trim($policy->description, '"') }}</td>
                    <td class="border p-2">
                        <ul class="list-disc list-inside">
                            @foreach($policy->guidances as $pg)
                                <li>{{ trim($pg->guidance, '"') }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="border p-2">
                        @foreach($policy->guidances as $pg)
                            <span>{{ trim($pg->reference, '"') }}</span><br>
                        @endforeach
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="p-2 text-gray-500">No policies available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Component: Culture, Ethics and Behavior --}}
    <div class="overflow-x-auto mt-8 mb-8">
        <table class="min-w-full border mt-8">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="p-2">Component: Culture, Ethics and Behavior</th>
                    <th class="p-2">Related Guidance</th>
                    <th class="p-2">Detailed Reference</th>
                </tr>
            </thead>
            <tbody>
                @forelse($objective->keyculture as $kc)
                <tr>
                    <td class="border p-2">{{ trim($kc->element, '"') }}</td>
                    <td class="border p-2">
                        @if($kc->guidances->count())
                            <ul class="list-disc list-inside">
                                @foreach($kc->guidances as $kg)
                                    <li>{{ trim($kg->guidance, '"') }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="border p-2">
                        @foreach($kc->guidances as $kg)
                            <span>{{ trim($kg->pivot->reference ?? '-', '"') }}</span><br>
                        @endforeach
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="p-2 text-gray-500">No key culture elements available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Component: Services, Infrastructure and Applications --}}
    <div class="overflow-x-auto mb-8">
        <table class="min-w-full border">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="p-2">Component: Services, Infrastructure and Applications</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-2">
                        <ul class="list-disc list-inside">
                            @foreach($objective->s_i_a as $sia)
                                <li>{{ trim($sia->description, '"') }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
