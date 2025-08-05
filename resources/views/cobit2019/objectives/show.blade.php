// resources/views/objectives/show.blade.php

@php
  $guidanceByComponent = collect($objective['guidance'])
    ->groupBy(fn($g) => $g['pivot']['component']);
@endphp

@extends('layouts.app')
@section('content')
<head>
    <title>Objective: {{ $objective->objective_id }} - {{ $objective->objective }}</title>
    {{-- @vite('resources/css/app.css') --}}
</head>
<div class="container mx-auto p-6 mb-8" x-data="{ 
    activeComponent: 'overview',
    init() {
        // Check for URL hash parameter
        const hash = window.location.hash.substring(1);
        const validComponents = ['overview', 'goals', 'practices', 'infoflows', 'organizational', 'policies', 'skills', 'culture', 'services'];
        
        if (hash && validComponents.includes(hash)) {
            this.activeComponent = hash;
        } else {
            // Check for URL query parameter
            const urlParams = new URLSearchParams(window.location.search);
            const component = urlParams.get('component');
            if (component && validComponents.includes(component)) {
                this.activeComponent = component;
            }
        }
        
        // Update URL hash when component changes
        this.$watch('activeComponent', (value) => {
            window.location.hash = value;
        });
    }
}">
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

    {{-- Component Navigation --}}
    {{-- <div class="bg-white shadow rounded mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <button @click="activeComponent = 'overview'; window.location.hash = 'overview'" 
                        :class="activeComponent === 'overview' ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                        class="whitespace-nowrap py-4 px-3 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    Overview
                </button>
                <button @click="activeComponent = 'goals'; window.location.hash = 'goals'" 
                        :class="activeComponent === 'goals' ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                        class="whitespace-nowrap py-4 px-3 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    Goals
                </button>
                <button @click="activeComponent = 'practices'; window.location.hash = 'practices'" 
                        :class="activeComponent === 'practices' ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                        class="whitespace-nowrap py-4 px-3 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    Practices
                </button>
                <button @click="activeComponent = 'infoflows'; window.location.hash = 'infoflows'" 
                        :class="activeComponent === 'infoflows' ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                        class="whitespace-nowrap py-4 px-3 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    Information Flows
                </button>
                <button @click="activeComponent = 'organizational'; window.location.hash = 'organizational'" 
                        :class="activeComponent === 'organizational' ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                        class="whitespace-nowrap py-4 px-3 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    Organizational
                </button>
                <button @click="activeComponent = 'policies'; window.location.hash = 'policies'" 
                        :class="activeComponent === 'policies' ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                        class="whitespace-nowrap py-4 px-3 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    Policies
                </button>
                <button @click="activeComponent = 'skills'; window.location.hash = 'skills'" 
                        :class="activeComponent === 'skills' ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                        class="whitespace-nowrap py-4 px-3 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    Skills
                </button>
                <button @click="activeComponent = 'culture'; window.location.hash = 'culture'" 
                        :class="activeComponent === 'culture' ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                        class="whitespace-nowrap py-4 px-3 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    Culture & Ethics
                </button>
                <button @click="activeComponent = 'services'; window.location.hash = 'services'" 
                        :class="activeComponent === 'services' ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                        class="whitespace-nowrap py-4 px-3 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                    Services
                </button>
            </nav>
        </div>
    </div> --}}
    <div class="bg-white shadow rounded mb-6">
        <div class="flex border-b border-gray-200">
            <nav class="-mb-px space-x-8 px-6 flex-col sm:flex-row" aria-label="Tabs">
                @php
                    $tabs = ['overview' => 'Overview','goals'=>'Goals','practices'=>'Practices','infoflows'=>'Information Flows','organizational'=>'Organizational','policies'=>'Policies','skills'=>'Skills','culture'=>'Culture & Ethics','services'=>'Services'];
                @endphp
                @foreach($tabs as $key => $label)
                    {{-- <button
                        @click="activeComponent='{{ $key }}'"
                        :class="activeComponent==='{{ $key }}'
                            ? 'border-indigo-500 text-indigo-600 bg-indigo-50'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                        class="whitespace-nowrap py-4 px-3 border-b-2 font-medium text-sm rounded-t-lg transition-all duration-200">
                        {{ $label }}
                    </button> --}}
                    <button
                        @click="activeComponent='{{ $key }}'"
                        type="button"
                        class="px-4 py-2 transition-colors duration-200 text-sm font-medium rounded-t-lg"
                        :class="activeComponent === '{{ $key }}' 
                            ? 'text-blue-600 bg-indigo-600 border-b-2 border-indigo-600' 
                            : 'text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:bg-gray-100 hover:border-gray-300'"
                    >
                        {{ $label }}
                    </button>

                @endforeach
            </nav>
        </div>
    </div>
    

    {{-- Overview Component --}}
    <div x-show="activeComponent === 'overview'" class="component-section">
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
    </div>

    {{-- Goals Component --}}
    <div x-show="activeComponent === 'goals'" class="component-section">
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
    </div>

    {{-- Practices Component --}}
    <div x-show="activeComponent === 'practices'" class="component-section">
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
    </div>

    {{-- Information Flows Component --}}
    <div x-show="activeComponent === 'infoflows'" class="component-section">
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
    </div>

    {{-- Organizational Structures Component --}}
    <div x-show="activeComponent === 'organizational'" class="component-section">
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
    </div>

    {{-- Policies Component --}}
    <div x-show="activeComponent === 'policies'" class="component-section">
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
    </div>

    {{-- Skills Component --}}
    <div x-show="activeComponent === 'skills'" class="component-section">
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
    </div>

    {{-- Culture, Ethics and Behavior Component --}}
    <div x-show="activeComponent === 'culture'" class="component-section">
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
                                    <li>{{ trim($kg['reference'] ?? '', '"') }}</li>
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
    </div>

    {{-- Services, Infrastructure and Applications Component --}}
    <div x-show="activeComponent === 'services'" class="component-section">
        <div class="mt-4 mb-4">
            <h2 class="text-xl font-semibold mb-2">Services, Infrastructure and Applications</h2>
            <ul class="list-disc list-inside ml-4">
                @foreach($objective['s_i_a'] as $sia)
                    <li>{{ trim($sia['description'], '"') }}</li>
                @endforeach
            </ul>
        </div>
    </div>

</div>

{{-- Add Alpine.js CDN if not already included in your layout --}}
@push('scripts')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@endsection

