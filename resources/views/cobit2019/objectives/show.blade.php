// resources/views/objectives/show.blade.php
@extends('layouts.app')

@section('content')
{{-- <style>
    table, th, td {
        border: 1px solid gray;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }
</style> --}}
<div class="container mx-auto p-4 mt-8">
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

    {{-- Header Table --}}
    <div class="overflow-x-auto my-8 py-6">
        <table class="min-w-full border-collapse border-2 border-gray-400 shadow-lg">
            <thead>
                <tr class="bg-red-700 text-black">
                    <th colspan="3" class="border border-gray-300 p-2 text-left">Domain: {{ $objective->domains->first()->pivot->domain ?? '-' }}</th>
                    <th class="border border-gray-300 p-2 text-left">Focus Area: COBIT Core Model</th>
                </tr>
                <tr class="bg-gray-200">
                    <th colspan="2" class="border border-gray-300 p-2 text-left">Governance Objective: {{ $objective->objective_id }} – {{ $objective->objective }}</th>
                    <th colspan="2" class="border border-gray-300 p-2"></th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr>
                    <td class="border border-gray-300 p-2 font-semibold">Description</td>
                    <td colspan="3" class="border border-gray-300 p-2">{{ $objective->objective_description }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2 font-semibold">Purpose</td>
                    <td colspan="3" class="border border-gray-300 p-2">{{ $objective->objective_purpose }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Enterprise & Alignment Goals --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 my-8 py-6">
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border-2 border-gray-400 shadow-lg">
                <thead class="bg-gray-300">
                    <tr>
                        <th colspan="2" class="border border-gray-300 p-2 text-left">Enterprise Goals</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($objective->entergoals ?? [] as $eg)
                    <tr>
                        <td class="border border-gray-300 p-2 align-top font-semibold">{{ $eg->entergoals_id }}</td>
                        <td class="border border-gray-300 p-2">
                            <ul class="list-disc list-inside">
                                @if(isset($eg->entergoalsmetr) && $eg->entergoalsmetr)
                                    @foreach($eg->entergoalsmetr as $m)
                                        <li>{{ trim($m->description, '"') }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="border border-gray-300 p-2 text-gray-500">No enterprise goals.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border-2 border-gray-400 shadow-lg">
                <thead class="bg-gray-300">
                    <tr>
                        <th colspan="2" class="border border-gray-300 p-2 text-left">Alignment Goals</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($objective->aligngoals ?? [] as $ag)
                    <tr>
                        <td class="border border-gray-300 p-2 align-top font-semibold">{{ $ag->aligngoals_id }}</td>
                        <td class="border border-gray-300 p-2">
                            <ul class="list-disc list-inside">
                                @if(isset($ag->aligngoalsmetr) && $ag->aligngoalsmetr)
                                    @foreach($ag->aligngoalsmetr as $m)
                                        <li>{{ trim($m->description, '"') }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="border border-gray-300 p-2 text-gray-500">No alignment goals.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Component: Process (Practices) --}}
    @if(isset($objective->practices) && $objective->practices)
        @foreach($objective->practices as $practice)
        <div class="overflow-x-auto my-8 py-6">
            <table class="min-w-full border-collapse border-2 border-gray-400 shadow-lg">
                <thead>
                    <tr class="bg-blue-800 text-black">
                        <th class="border border-gray-300 p-2 text-left">Component: Process</th>
                        <th class="border border-gray-300 p-2 text-left" colspan="3">Governance Practice: {{ trim($practice->practice_id, '"') }} – {{ trim($practice->practice_name, '"') }}</th>
                    </tr>
                    <tr class="bg-pink-700 text-black">
                        <th class="border border-gray-300 p-2 text-left">Example Metrics</th>
                        <th class="border border-gray-300 p-2 text-left" colspan="3">
                            <ul class="list-disc list-inside">
                                @if(isset($practice->practicemetr) && $practice->practicemetr)
                                    @foreach($practice->practicemetr as $pm)
                                        <li>{{ trim($pm->description, '"') }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 p-2 font-semibold">Activities</td>
                        <td colspan="2" class="border border-gray-300 p-2">
                            <ol class="list-decimal list-inside">
                                @if(isset($practice->activities) && $practice->activities)
                                    @foreach($practice->activities as $act)
                                        <li>{{ trim($act->description, '"') }}</li>
                                    @endforeach
                                @endif
                            </ol>
                        </td>
                        <td class="border border-gray-300 p-2 text-center">{{ $practice->activities->last()->capability_lvl ?? '-' }}</td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td colspan="4" class="border border-gray-300 p-2 font-semibold">Related Guidance</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border border-gray-300 p-2">
                            <ul class="list-disc list-inside">
                                @if(isset($practice->guidances) && $practice->guidances)
                                    @foreach($practice->guidances as $gd)
                                        <li>{{ trim($gd->guidance, '"') }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                        <td colspan="2" class="border border-gray-300 p-2">
                            <ul class="list-disc list-inside">
                                @if(isset($practice->guidances) && $practice->guidances)
                                    @foreach($practice->guidances as $gd)
                                        <li>{{ trim($gd->reference, '"') }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
    @endif

    {{-- Component: Organizational Structures --}}
    <div class="overflow-x-auto my-8 py-6">
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
    </div>

    {{-- Component: Information Flows and Items --}}
    <div class="overflow-x-auto my-8 py-6">
        <table class="min-w-full border-collapse border-2 border-gray-400 shadow-lg">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="border border-gray-300 p-2">Component: Information Flows and Items</th>
                    <th class="border border-gray-300 p-2">Inputs</th>
                    <th class="border border-gray-300 p-2">Outputs</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($objective->practices) && $objective->practices)
                    @foreach($objective->practices as $practice)
                    <tr>
                        <td class="border border-gray-300 p-2 font-semibold">{{ trim($practice->practice_id, '"') }}</td>
                        <td class="border border-gray-300 p-2">
                            <ul class="list-disc list-inside">
                                @if(isset($practice->infoflowinput) && $practice->infoflowinput)
                                    @foreach($practice->infoflowinput as $inp)
                                        <li>
                                            <strong>{{ $inp->from }}:</strong> {{ trim($inp->description, '"') }}
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                        <td class="border border-gray-300 p-2">
                            <ul class="list-disc list-inside">
                                @if(isset($practice->infoflowoutput) && $practice->infoflowoutput)
                                    @foreach($practice->infoflowoutput as $out)
                                        <li>
                                            <strong>{{ $out->to }}:</strong> {{ trim($out->description, '"') }}
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Component: People, Skills and Competencies --}}
    <div class="overflow-x-auto my-8 py-6">
        <table class="min-w-full border-collapse border-2 border-gray-400 shadow-lg">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="border border-gray-300 p-2">Component: People, Skills and Competencies</th>
                    <th class="border border-gray-300 p-2">Related Guidance</th>
                    <th class="border border-gray-300 p-2">Detailed Reference</th>
                </tr>
            </thead>
            <tbody>
                @forelse($objective->skill ?? [] as $sk)
                <tr>
                    <td class="border border-gray-300 p-2">{{ trim($sk->skill, '"') }}</td>
                    <td class="border border-gray-300 p-2">
                        @if(isset($sk->guidances) && $sk->guidances && $sk->guidances->count())
                            <ul class="list-disc list-inside">
                                @foreach($sk->guidances as $sg)
                                    <li>{{ trim($sg->guidance, '"') }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 p-2">{{ $sk->guidances->first()->pivot->reference ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="border border-gray-300 p-2 text-gray-500">No skills available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Component: Principles, Policies and Procedures --}}
    <div class="overflow-x-auto my-8 py-6">
        <table class="min-w-full border-collapse border-2 border-gray-400 shadow-lg">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="border border-gray-300 p-2">Component: Principles, Policies and Procedures</th>
                    <th class="border border-gray-300 p-2">Policy Description</th>
                    <th class="border border-gray-300 p-2">Related Guidance</th>
                    <th class="border border-gray-300 p-2">Detailed Reference</th>
                </tr>
            </thead>
            <tbody>
                @forelse($objective->policies ?? [] as $policy)
                <tr>
                    <td class="border border-gray-300 p-2">{{ trim($policy->policy, '"') }}</td>
                    <td class="border border-gray-300 p-2">{{ trim($policy->description, '"') }}</td>
                    <td class="border border-gray-300 p-2">
                        <ul class="list-disc list-inside">
                            @if(isset($policy->guidances) && $policy->guidances)
                                @foreach($policy->guidances as $pg)
                                    <li>{{ trim($pg->guidance, '"') }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </td>
                    <td class="border border-gray-300 p-2">
                        @if(isset($policy->guidances) && $policy->guidances)
                            @foreach($policy->guidances as $pg)
                                <span>{{ trim($pg->reference, '"') }}</span><br>
                            @endforeach
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="border border-gray-300 p-2 text-gray-500">No policies available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Component: Culture, Ethics and Behavior --}}
    <div class="overflow-x-auto my-8 py-6">
        <table class="min-w-full border-collapse border-2 border-gray-400 shadow-lg">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="border border-gray-300 p-2">Component: Culture, Ethics and Behavior</th>
                    <th class="border border-gray-300 p-2">Related Guidance</th>
                    <th class="border border-gray-300 p-2">Detailed Reference</th>
                </tr>
            </thead>
            <tbody>
                @forelse($objective->keyculture ?? [] as $kc)
                <tr>
                    <td class="border border-gray-300 p-2">{{ trim($kc->element, '"') }}</td>
                    <td class="border border-gray-300 p-2">
                        @if(isset($kc->guidances) && $kc->guidances && $kc->guidances->count())
                            <ul class="list-disc list-inside">
                                @foreach($kc->guidances as $kg)
                                    <li>{{ trim($kg->guidance, '"') }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 p-2">
                        @if(isset($kc->guidances) && $kc->guidances)
                            @foreach($kc->guidances as $kg)
                                <span>{{ trim($kg->pivot->reference ?? '-', '"') }}</span><br>
                            @endforeach
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="border border-gray-300 p-2 text-gray-500">No key culture elements available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Component: Services, Infrastructure and Applications --}}
    <div class="overflow-x-auto my-8 py-6">
        <table class="min-w-full border-collapse border-2 border-gray-400 shadow-lg">
            <thead class="bg-blue-800 text-black">
                <tr>
                    <th class="border border-gray-300 p-2">Component: Services, Infrastructure and Applications</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 p-2">
                        <ul class="list-disc list-inside">
                            @if(isset($objective->s_i_a) && $objective->s_i_a)
                                @foreach($objective->s_i_a as $sia)
                                    <li>{{ trim($sia->description, '"') }}</li>
                                @endforeach
                            @else
                                <li class="text-gray-500">No services, infrastructure and applications available.</li>
                            @endif
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

