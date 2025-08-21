@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">All Objectives</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($objectives as $objective)
            <div x-data="{ open: false }" class="border rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                {{-- Card header (clickable) --}}
                <div @click="open = !open" class="cursor-pointer flex justify-between items-center p-4 hover:bg-gray-50 transition-colors duration-200">
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $objective->objective_id }} – {{ $objective->objective }}
                    </h2>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">
                            {{ $objective->practices->count() }} practices
                        </span>
                        <svg x-show="!open" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <svg x-show="open" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                    </div>
                </div>

                {{-- Expandable content --}}
                <div x-show="open" x-collapse class="border-t bg-gray-50">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-3 text-gray-700">Practices</h3>
                        
                        @foreach($objective->practices as $practice)
                            <div class="bg-white border rounded-lg p-4 mb-3 shadow-sm">
                                <h4 class="font-medium text-gray-800 mb-2">
                                    {{ $practice->practice_id }}: {{ $practice->practice_name }}
                                </h4>
                                <p class="text-gray-600 mb-3">{{ $practice->practice_description }}</p>

                                {{-- Activities --}}
                                @if($practice->activities && $practice->activities->count() > 0)
                                    <h5 class="font-semibold mb-2 text-gray-700">Activities</h5>
                                    <ul class="list-disc ml-5 space-y-1">
                                        @foreach($practice->activities as $activity)
                                            <li class="text-gray-600">
                                                {{ $activity->description }} 
                                                @if($activity->capability_lvl)
                                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full ml-2">
                                                        Level: {{ $activity->capability_lvl }}
                                                    </span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-500 italic">No activities defined for this practice.</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
