@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container mx-auto p-6">
    {{-- Main Card --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">COBIT 2019 Assessment Evaluation</h3>
                    <small class="opacity-75">Assessment ID: #{{ $evalId }}</small>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-light text-dark px-3 py-2">
                        {{ $objectives->count() }} Objectives to Evaluate
                    </span>
                    <div class="btn-group" role="group">
                        <a href="{{ route('assessment-eval.list') }}" class="btn btn-light btn-sm" title="Back to List">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                        <button type="button" class="btn btn-light btn-sm" id="save-assessment" title="Save Assessment">
                            <i class="fas fa-save me-1"></i>Save
                        </button>
                        <button type="button" class="btn btn-light btn-sm" id="load-assessment" title="Load Assessment">
                            <i class="fas fa-sync me-1"></i>Reload
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="mb-3">Evaluate the capability level of each COBIT 2019 governance and management objective</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="rating-scale-info">
                        <strong class="text-muted d-block mb-2">Rating Scale:</strong>
                        <small class="text-muted d-block">N (None) = 0</small>
                        <small class="text-muted d-block">P (Partial) = 1/3</small>
                        <small class="text-muted d-block">L (Largely) = 2/3</small>
                        <small class="text-muted d-block">F (Fully) = 1</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">
                        <strong>Capability Levels:</strong> Start with the lowest available level and progress based on scores
                    </small>
                </div>
            </div>
        </div>
    </div>

    {{-- Domain Filter Buttons --}}
    <div class="btn-group mb-4 shadow-sm w-100" role="group">
        <button type="button" class="btn btn-outline-primary px-3 py-2 domain-filter active" data-domain="all">
            <i class="fas fa-th-large me-2"></i>All Domains
        </button>
        <button type="button" class="btn btn-outline-success px-3 py-2 domain-filter" data-domain="EDM">
            <i class="fas fa-users-cog me-2"></i>EDM
        </button>
        <button type="button" class="btn btn-outline-info px-3 py-2 domain-filter" data-domain="APO">
            <i class="fas fa-cogs me-2"></i>APO
        </button>
        <button type="button" class="btn btn-outline-warning px-3 py-2 domain-filter" data-domain="BAI">
            <i class="fas fa-hammer me-2"></i>BAI
        </button>
        <button type="button" class="btn btn-outline-danger px-3 py-2 domain-filter" data-domain="DSS">
            <i class="fas fa-life-ring me-2"></i>DSS
        </button>
        <button type="button" class="btn btn-outline-dark px-3 py-2 domain-filter" data-domain="MEA">
            <i class="fas fa-chart-line me-2"></i>MEA
        </button>
    </div>

    {{-- Objectives Cards --}}
    <div class="row" id="objectives-container">
        @foreach($objectives as $objective)
            @php
                $domain = preg_replace('/\d+/', '', $objective->objective_id);
            @endphp
            <div class="col-12 mb-4 objective-card" data-domain="{{ $domain }}" data-objective-id="{{ $objective->objective_id }}">
                <div class="card shadow-sm h-100">
                    {{-- Card Header --}}
                    <div class="card-header d-flex justify-content-between align-items-center py-3
                        @if($domain == 'EDM') bg-success text-white
                        @elseif($domain == 'APO') bg-info text-white  
                        @elseif($domain == 'BAI') bg-warning text-dark
                        @elseif($domain == 'DSS') bg-danger text-white
                        @elseif($domain == 'MEA') bg-dark text-white
                        @else bg-secondary text-white @endif">
                        <div>
                            <h5 class="mb-1 fw-bold">{{ $objective->objective_id }} - {{ $objective->objective }}</h5>
                            @php
                                $domainFullNames = [
                                    'EDM' => 'Evaluate, Direct, and Monitor',
                                    'APO' => 'Align, Plan, and Organize',
                                    'BAI' => 'Build, Acquire, and Implement',
                                    'DSS' => 'Deliver, Service, and Support',
                                    'MEA' => 'Monitor, Evaluate, and Assess'
                                ];
                                $fullDomainName = $domainFullNames[$domain] ?? $domain;
                            @endphp
                            <small class="opacity-75">{{ $fullDomainName }}</small>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            @php
                                $totalLevel2Activities = $objective->practices->sum(function($practice) {
                                    return $practice->activities ? $practice->activities->where('capability_lvl', 2)->count() : 0;
                                });
                            @endphp
                            <span class="badge bg-light text-dark px-2 py-1">
                                {{ $totalLevel2Activities }} activities
                            </span>
                            <div class="capability-level-display">
                                <span class="badge fs-6 px-3 py-2 bg-danger" id="capability-level-{{ $objective->objective_id }}">
                                    Level <span class="level-number">1</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body">
                        @if($objective->objective_description)
                            <p class="card-text text-muted mb-3">
                                {{ $objective->objective_description }}
                            </p>
                        @endif

                        @if($objective->objective_purpose)
                            <div class="mb-3">
                                <small class="text-muted">
                                    <strong>Purpose:</strong> {{ $objective->objective_purpose }}
                                </small>
                            </div>
                        @endif
                    </div>

                    {{-- Card Footer with Multi-Level Assessment --}}
                    <div class="card-footer bg-light">
                        @php
                            $availableLevels = [];
                            foreach($objective->practices as $practice) {
                                if($practice->activities) {
                                    foreach($practice->activities as $activity) {
                                        if(!in_array($activity->capability_lvl, $availableLevels)) {
                                            $availableLevels[] = $activity->capability_lvl;
                                        }
                                    }
                                }
                            }
                            sort($availableLevels);
                            $minLevel = min($availableLevels ?? [2]);
                            $maxLevel = min(5, max($availableLevels ?? [2]));
                        @endphp
                        
                        @for($level = $minLevel; $level <= $maxLevel; $level++)
                            @php
                                $levelActivities = 0;
                                foreach($objective->practices as $practice) {
                                    if($practice->activities) {
                                        $levelActivities += $practice->activities->where('capability_lvl', $level)->count();
                                    }
                                }
                            @endphp
                            @if($levelActivities > 0)
                                <div class="capability-level-section mb-3" data-level="{{ $level }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <small class="text-muted fw-bold">
                                                <i class="fas fa-clipboard-check me-1"></i>
                                                Capability Level {{ $level }} - Evaluate {{ $levelActivities }} Activities
                                            </small>
                                            <span class="badge bg-secondary capability-score" id="level-score-{{ $objective->objective_id }}-{{ $level }}">
                                                N (0.00)
                                            </span>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary toggle-level-details" type="button" 
                                                data-objective-id="{{ $objective->objective_id }}"
                                                data-level="{{ $level }}"
                                                data-min-level="{{ $minLevel }}"
                                                data-required-previous="{{ $level > $minLevel ? 'true' : 'false' }}">
                                            <i class="fas me-1 fa-chevron-down toggle-icon"></i>
                                            <span class="toggle-text">Start Assessment</span>
                                        </button>
                                    </div>
                                    
                                    {{-- Assessment Section for this level --}}
                                    <div class="assessment-section mt-3" id="assessment-{{ $objective->objective_id }}-{{ $level }}" style="display: none;">
                                        <div class="border-top pt-3">
                                            <div class="row mb-3">
                                                <div class="col-md-8">
                                                    <h6 class="fw-bold text-primary">
                                                        <i class="fas fa-clipboard-check me-2"></i>Level {{ $level }} Capability Assessment
                                                    </h6>
                                                    <div class="rating-info">
                                                        <small class="text-muted d-block">N (None) = 0</small>
                                                        <small class="text-muted d-block">P (Partial) = 1/3</small>
                                                        <small class="text-muted d-block">L (Largely) = 2/3</small>
                                                        <small class="text-muted d-block">F (Fully) = 1</small>
                                                        <small class="text-muted d-block mt-2">
                                                            <strong>Capability Levels:</strong> Start with the lowest available level and progress based on scores
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-end">
                                                    <div class="capability-score-display">
                                                        <small class="text-muted d-block">Current Capability Level</small>
                                                        <span class="badge fs-5 px-3 py-2 bg-danger" id="capability-score-{{ $objective->objective_id }}-{{ $level }}">
                                                            Level <span class="level-number">1</span>
                                                        </span>
                                                        <div class="mt-2">
                                                            <small class="text-muted d-block">Average Score</small>
                                                            <span class="badge bg-secondary" id="average-score-{{ $objective->objective_id }}-{{ $level }}">
                                                                0.00
                                                            </span>
                                                        </div>
                                                        <div class="mt-1">
                                                            <small class="text-muted d-block">Activities Rated</small>
                                                            <span class="badge bg-info" id="activities-count-{{ $objective->objective_id }}-{{ $level }}">
                                                                0/{{ $levelActivities }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            {{-- Activities Assessment for this level --}}
                                            @php $activityCounter = 1; @endphp
                                            @forelse($objective->practices as $practice)
                                                @php
                                                    $levelSpecificActivities = $practice->activities ? $practice->activities->where('capability_lvl', $level) : collect();
                                                @endphp
                                                @if($levelSpecificActivities->count() > 0)
                                                    <div class="practice-section mb-4">
                                                        <h6 class="fw-semibold text-dark mb-3">
                                                            <span class="badge bg-primary me-2">{{ $practice->practice_id }}</span>
                                                            {{ $practice->practice_name }}
                                                            <span class="badge bg-info ms-2">{{ $levelSpecificActivities->count() }} Activities</span>
                                                        </h6>
                                                        
                                                        @foreach($levelSpecificActivities as $activity)
                                                            <div class="activity-assessment mb-3 p-3 border rounded bg-light">
                                                                <div class="row align-items-center">
                                                                    <div class="col-md-1 text-center">
                                                                        <span class="badge bg-secondary fs-6">{{ $activityCounter }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="mb-2 fw-medium">{{ $activity->description }}</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="rating-slider">
                                                                            <div class="btn-group w-100" role="group">
                                                                                @foreach(['N' => 'None', 'P' => 'Partial', 'L' => 'Largely', 'F' => 'Fully'] as $rating => $label)
                                                                                    <input type="radio" 
                                                                                           class="btn-check activity-rating" 
                                                                                           name="activity_{{ $activity->activity_id }}" 
                                                                                           id="activity_{{ $activity->activity_id }}_{{ $rating }}" 
                                                                                           value="{{ $rating }}"
                                                                                           data-activity-id="{{ $activity->activity_id }}"
                                                                                           data-objective-id="{{ $objective->objective_id }}"
                                                                                           data-level="{{ $level }}">
                                                                                    <label class="btn btn-outline-secondary btn-sm" 
                                                                                           for="activity_{{ $activity->activity_id }}_{{ $rating }}">
                                                                                        {{ $rating }}
                                                                                    </label>
                                                                                @endforeach
                                                                                {{-- Clear button --}}
                                                                                <button type="button" 
                                                                                        class="btn btn-outline-danger btn-sm clear-rating" 
                                                                                        data-activity-id="{{ $activity->activity_id }}"
                                                                                        data-objective-id="{{ $objective->objective_id }}"
                                                                                        data-level="{{ $level }}"
                                                                                        title="Clear rating">
                                                                                    <i class="fas fa-times"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="mt-2 d-flex justify-content-between align-items-center">
                                                                                <small class="text-muted">
                                                                                    N=0, P=0.33, L=0.67, F=1
                                                                                </small>
                                                                                <span class="badge bg-light text-dark activity-score" id="score-{{ $activity->activity_id }}">
                                                                                    Score: 0
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- Evidence / Notes section --}}
                                                                <div class="row mt-3">
                                                                    <div class="col-md-1"></div>
                                                                    <div class="col-md-11">
                                                                        <div class="evidence-notes-section">
                                                                            <label for="evidence_{{ $activity->activity_id }}" class="form-label text-muted">
                                                                                <i class="fas fa-clipboard-list me-1"></i>
                                                                                <small><strong>Evidence / Notes:</strong></small>
                                                                            </label>
                                                                            <textarea 
                                                                                class="form-control form-control-sm evidence-notes" 
                                                                                id="evidence_{{ $activity->activity_id }}" 
                                                                                name="evidence_{{ $activity->activity_id }}"
                                                                                data-activity-id="{{ $activity->activity_id }}"
                                                                                data-objective-id="{{ $objective->objective_id }}"
                                                                                data-level="{{ $level }}"
                                                                                rows="2" 
                                                                                placeholder="Enter evidence, documentation references, or notes to support your rating..."></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php $activityCounter++; @endphp
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="text-center py-4">
                                                    <i class="fas fa-info-circle text-muted me-2"></i>
                                                    <span class="text-muted">No practices with Level {{ $level }} activities found for assessment.</span>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- No Results Message --}}
    <div id="no-results" class="text-center py-5" style="display: none;">
        <div class="card shadow-sm">
            <div class="card-body py-5">
                <i class="fas fa-search text-muted mb-3" style="font-size: 3rem;"></i>
                <h5 class="text-muted">No objectives found</h5>
                <p class="text-muted">Try selecting a different domain filter.</p>
            </div>
        </div>
    </div>
</div>

<script>
class COBITAssessmentManager {
    constructor(evalId) {
        this.assessmentData = {};
        this.levelScores = {};
        this.currentEvalId = evalId;
        this.init();
    }

    init() {
        this.setupDomainFiltering();
        this.setupAssessmentToggles();
        this.setupActivityRating();
        this.initializeDefaultStates();
        this.setupSaveLoadButtons();
        this.loadAssessment();
    }

    initializeDefaultStates() {
        const objectiveCards = document.querySelectorAll('.objective-card');
        objectiveCards.forEach(card => {
            const objectiveId = card.getAttribute('data-objective-id');
            const levelSections = card.querySelectorAll('.capability-level-section');
            
            levelSections.forEach(section => {
                const level = parseInt(section.getAttribute('data-level'));
                this.initializeLevelScore(objectiveId, level);
                this.updateLevelDisplay(objectiveId, level);
                this.checkLevelLock(objectiveId, level);
            });
        });
    }

    initializeLevelScore(objectiveId, level) {
        if (!this.levelScores[objectiveId]) {
            this.levelScores[objectiveId] = {};
        }
        if (!this.levelScores[objectiveId][level]) {
            this.levelScores[objectiveId][level] = {
                letter: 'N',
                score: 0.00,
                activities: {},
                evidence: {}
            };
        }
    }

    setupSaveLoadButtons() {
        const saveBtn = document.getElementById('save-assessment');
        const loadBtn = document.getElementById('load-assessment');

        if (saveBtn) {
            saveBtn.addEventListener('click', () => this.saveAssessment());
        }

        if (loadBtn) {
            loadBtn.addEventListener('click', () => this.loadAssessment());
        }
    }

    async saveAssessment() {
        try {
            const assessmentData = {
                assessmentData: this.levelScores,
                notes: this.getNotesData()
            };

            const response = await fetch(`/assessment-eval/${this.currentEvalId}/save`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(assessmentData)
            });

            const result = await response.json();

            if (response.ok) {
                this.showNotification('Assessment saved successfully!', 'success');
            } else {
                this.showNotification(result.message || 'Failed to save assessment', 'error');
            }
        } catch (error) {
            console.error('Save error:', error);
            this.showNotification('Failed to save assessment', 'error');
        }
    }

    async loadAssessment() {
        try {
            const response = await fetch(`/assessment-eval/${this.currentEvalId}/load`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (response.ok && result.data) {
                this.populateAssessmentData(result.data);
                if (event && event.target && event.target.id === 'load-assessment') {
                    this.showNotification('Assessment loaded successfully!', 'success');
                }
            } else if (!response.ok) {
                console.log('No existing data found or error loading');
            }
        } catch (error) {
            console.error('Load error:', error);
            if (event && event.target && event.target.id === 'load-assessment') {
                this.showNotification('Failed to load assessment', 'error');
            }
        }
    }

    populateAssessmentData(data) {
        this.levelScores = {};
        
        document.querySelectorAll('.activity-rating').forEach(input => input.checked = false);
        document.querySelectorAll('.evidence-notes').forEach(textarea => textarea.value = '');

        const objectiveCards = document.querySelectorAll('.objective-card');
        objectiveCards.forEach(card => {
            const objectiveId = card.getAttribute('data-objective-id');
            const levelSections = card.querySelectorAll('.capability-level-section');
            
            levelSections.forEach(section => {
                const level = parseInt(section.getAttribute('data-level'));
                this.initializeLevelScore(objectiveId, level);
                
                const activityInputs = section.querySelectorAll('.activity-rating');
                const activityIds = new Set();
                activityInputs.forEach(input => {
                    const activityId = input.getAttribute('data-activity-id');
                    activityIds.add(activityId);
                });
                
                activityIds.forEach(activityId => {
                    this.levelScores[objectiveId][level].activities[activityId] = 0;
                });
            });
        });

        if (data.notes) {
            Object.keys(data.notes).forEach(activityId => {
                const textarea = document.querySelector(`textarea[data-activity-id="${activityId}"]`);
                if (textarea && data.notes[activityId]) {
                    textarea.value = data.notes[activityId];
                }
            });
        }

        if (data.activityData) {
            Object.keys(data.activityData).forEach(activityId => {
                const activityData = data.activityData[activityId];
                const levelAchieved = activityData.level_achieved;
                const capabilityLevel = activityData.capability_lvl;
                const objectiveId = activityData.objective_id;
                
                const radioInput = document.querySelector(`input[name="activity_${activityId}"][value="${levelAchieved}"]`);
                if (radioInput && objectiveId && capabilityLevel) {
                    radioInput.checked = true;
                    
                    if (this.levelScores[objectiveId] && this.levelScores[objectiveId][capabilityLevel]) {
                        this.levelScores[objectiveId][capabilityLevel].activities[activityId] = this.getRatingValue(levelAchieved);
                        
                        if (activityData.notes) {
                            this.levelScores[objectiveId][capabilityLevel].evidence[activityId] = activityData.notes;
                        }
                        
                        this.updateActivityScore(activityId, levelAchieved);
                    }
                }
            });
        }

        this.updateAllCalculations();
    }

    updateAllCalculations() {
        const objectiveCards = document.querySelectorAll('.objective-card');
        objectiveCards.forEach(card => {
            const objectiveId = card.getAttribute('data-objective-id');
            const levelSections = card.querySelectorAll('.capability-level-section');
            
            levelSections.forEach(section => {
                const level = parseInt(section.getAttribute('data-level'));
                this.updateLevelCapability(objectiveId, level);
                this.checkLevelLock(objectiveId, level);
            });
        });
    }

    getNotesData() {
        const notes = {};
        document.querySelectorAll('textarea[data-activity-id]').forEach(textarea => {
            const activityId = textarea.getAttribute('data-activity-id');
            if (textarea.value.trim()) {
                notes[activityId] = textarea.value.trim();
            }
        });
        return notes;
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }

    setupDomainFiltering() {
        const filterButtons = document.querySelectorAll('.domain-filter');
        const objectiveCards = document.querySelectorAll('.objective-card');
        const noResultsDiv = document.getElementById('no-results');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'btn-primary');
                    btn.classList.add('btn-outline-primary');
                });
                
                button.classList.remove('btn-outline-primary');
                button.classList.add('btn-primary', 'active');

                const selectedDomain = button.getAttribute('data-domain');
                let visibleCount = 0;

                objectiveCards.forEach(card => {
                    const cardDomain = card.getAttribute('data-domain');
                    
                    if (selectedDomain === 'all' || cardDomain === selectedDomain) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                noResultsDiv.style.display = visibleCount === 0 ? 'block' : 'none';
            });
        });
    }

    setupAssessmentToggles() {
        const toggleButtons = document.querySelectorAll('.toggle-level-details');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', () => {
                const objectiveId = button.getAttribute('data-objective-id');
                const level = button.getAttribute('data-level');
                const assessmentSection = document.getElementById(`assessment-${objectiveId}-${level}`);
                const icon = button.querySelector('.toggle-icon');
                const text = button.querySelector('.toggle-text');
                
                if (text.textContent === 'Locked') {
                    return;
                }
                
                if (assessmentSection.style.display === 'none' || !assessmentSection.style.display) {
                    assessmentSection.style.display = 'block';
                    assessmentSection.style.animation = 'slideDown 0.3s ease-out';
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                    text.textContent = 'Hide Assessment';
                } else {
                    assessmentSection.style.display = 'none';
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                    text.textContent = 'Start Assessment';
                }
            });
        });
    }

    setupActivityRating() {
        const ratingInputs = document.querySelectorAll('.activity-rating');
        const clearButtons = document.querySelectorAll('.clear-rating');
        const evidenceTextareas = document.querySelectorAll('.evidence-notes');
        
        ratingInputs.forEach(input => {
            input.addEventListener('change', () => {
                const activityId = input.getAttribute('data-activity-id');
                const objectiveId = input.getAttribute('data-objective-id');
                const level = parseInt(input.getAttribute('data-level'));
                const rating = input.value;
                
                this.setActivityRating(objectiveId, level, activityId, rating);
                this.updateActivityScore(activityId, rating);
                this.updateLevelCapability(objectiveId, level);
                this.checkAllLevelLocks(objectiveId);
            });
        });

        clearButtons.forEach(button => {
            button.addEventListener('click', () => {
                const activityId = button.getAttribute('data-activity-id');
                const objectiveId = button.getAttribute('data-objective-id');
                const level = parseInt(button.getAttribute('data-level'));
                
                const radioButtons = document.querySelectorAll(`input[name="activity_${activityId}"]`);
                radioButtons.forEach(radio => radio.checked = false);
                
                this.clearActivityRating(objectiveId, level, activityId);
                this.updateActivityScore(activityId, null);
                this.updateLevelCapability(objectiveId, level);
                this.checkAllLevelLocks(objectiveId);
            });
        });

        evidenceTextareas.forEach(textarea => {
            textarea.addEventListener('input', () => {
                const activityId = textarea.getAttribute('data-activity-id');
                const objectiveId = textarea.getAttribute('data-objective-id');
                const level = parseInt(textarea.getAttribute('data-level'));
                const evidence = textarea.value;
                
                this.setActivityEvidence(objectiveId, level, activityId, evidence);
            });
        });
    }

    setActivityRating(objectiveId, level, activityId, rating) {
        this.initializeLevelScore(objectiveId, level);
        this.levelScores[objectiveId][level].activities[activityId] = this.getRatingValue(rating);
    }

    setActivityEvidence(objectiveId, level, activityId, evidence) {
        this.initializeLevelScore(objectiveId, level);
        this.levelScores[objectiveId][level].evidence[activityId] = evidence;
    }

    clearActivityRating(objectiveId, level, activityId) {
        if (this.levelScores[objectiveId] && this.levelScores[objectiveId][level]) {
            delete this.levelScores[objectiveId][level].activities[activityId];
            delete this.levelScores[objectiveId][level].evidence[activityId];
            
            const evidenceTextarea = document.getElementById(`evidence_${activityId}`);
            if (evidenceTextarea) {
                evidenceTextarea.value = '';
            }
        }
    }

    updateActivityScore(activityId, rating) {
        const scoreElement = document.getElementById(`score-${activityId}`);
        if (scoreElement) {
            if (rating === null) {
                scoreElement.textContent = 'Score: 0';
                scoreElement.className = 'badge bg-light text-dark activity-score';
            } else {
                const score = this.getRatingValue(rating);
                scoreElement.textContent = `Score: ${score.toFixed(2)}`;
                scoreElement.className = `badge activity-score ${this.getScoreColorClass(score)}`;
            }
        }
    }

    updateLevelCapability(objectiveId, level) {
        const levelData = this.levelScores[objectiveId][level];
        const totalActivities = this.getTotalActivitiesForLevel(objectiveId, level);
        const ratedActivities = Object.keys(levelData.activities).length;
        
        let totalScore = 0;
        if (levelData.activities) {
            totalScore = Object.values(levelData.activities).reduce((sum, score) => sum + score, 0);
        }
        const averageScore = totalActivities > 0 ? totalScore / totalActivities : 0;
        
        levelData.score = averageScore;
        levelData.letter = this.getScoreLetter(averageScore);
        
        this.updateLevelDisplay(objectiveId, level);
        this.updateLevelStats(objectiveId, level, averageScore, ratedActivities, totalActivities);
    }

    updateLevelDisplay(objectiveId, level) {
        const levelData = this.levelScores[objectiveId][level];
        const scoreElement = document.getElementById(`level-score-${objectiveId}-${level}`);
        
        if (scoreElement) {
            scoreElement.textContent = `${levelData.letter} (${levelData.score.toFixed(2)})`;
            scoreElement.className = `badge capability-score ${this.getScoreColorClass(levelData.score)}`;
        }
    }

    updateLevelStats(objectiveId, level, averageScore, ratedActivities, totalActivities) {
        const capabilityLevel = this.calculateCapabilityFromScore(averageScore);
        const levelBadge = document.getElementById(`capability-score-${objectiveId}-${level}`);
        if (levelBadge) {
            this.updateCapabilityBadge(levelBadge, capabilityLevel);
        }
        
        const averageScoreElement = document.getElementById(`average-score-${objectiveId}-${level}`);
        if (averageScoreElement) {
            averageScoreElement.textContent = averageScore.toFixed(2);
            averageScoreElement.className = `badge ${this.getScoreColorClass(averageScore)}`;
        }
        
        const activitiesCountElement = document.getElementById(`activities-count-${objectiveId}-${level}`);
        if (activitiesCountElement) {
            activitiesCountElement.textContent = `${ratedActivities}/${totalActivities}`;
            const completionRatio = totalActivities > 0 ? ratedActivities / totalActivities : 0;
            activitiesCountElement.className = `badge ${this.getCompletionColorClass(completionRatio)}`;
        }
    }

    getMinLevelForObjective(objectiveId) {
        const firstButton = document.querySelector(`[data-objective-id="${objectiveId}"].toggle-level-details`);
        if (firstButton) {
            return parseInt(firstButton.getAttribute('data-min-level')) || 2;
        }
        return 2;
    }

    checkLevelLock(objectiveId, level) {
        const minLevel = this.getMinLevelForObjective(objectiveId);
        
        if (level === minLevel) {
            return;
        }
        
        const previousLevel = level - 1;
        const prevLevelData = this.levelScores[objectiveId] && this.levelScores[objectiveId][previousLevel];
        const isLocked = !prevLevelData || prevLevelData.letter !== 'F';
        
        const button = document.querySelector(`[data-objective-id="${objectiveId}"][data-level="${level}"]`);
        const scoreElement = document.getElementById(`level-score-${objectiveId}-${level}`);
        
        if (button && scoreElement) {
            if (isLocked) {
                button.querySelector('.toggle-text').textContent = 'Locked';
                button.disabled = true;
                button.classList.add('btn-secondary');
                button.classList.remove('btn-outline-primary');
                scoreElement.textContent = 'N (0.00)';
                scoreElement.className = 'badge capability-score bg-secondary text-white';
                
                // Also lock the level data
                this.levelScores[objectiveId][level] = {
                    letter: 'N',
                    score: 0.00,
                    activities: {},
                    evidence: {}
                };
            } else {
                button.querySelector('.toggle-text').textContent = 'Start Assessment';
                button.disabled = false;
                button.classList.remove('btn-secondary');
                button.classList.add('btn-outline-primary');
            }
        }
    }

    checkAllLevelLocks(objectiveId) {
        const objectiveCard = document.querySelector(`[data-objective-id="${objectiveId}"].objective-card`);
        if (objectiveCard) {
            const levelSections = objectiveCard.querySelectorAll('.capability-level-section');
            levelSections.forEach(section => {
                const level = parseInt(section.getAttribute('data-level'));
                this.checkLevelLock(objectiveId, level);
            });
        }
    }

    getScoreLetter(score) {
        if (score > 0.85) return 'F';
        if (score > 0.50) return 'L';
        if (score > 0.15) return 'P';
        return 'N';
    }

    calculateCapabilityFromScore(score) {
        if (score <= 0.15) return 1;
        if (score <= 0.5) return 1;
        if (score <= 0.85) return 2;
        return 2;
    }

    updateCapabilityBadge(badge, level) {
        badge.className = badge.className.replace(/bg-(danger|warning|info|primary|success)/g, '');
        
        const levelConfig = {
            1: { class: 'bg-danger', textClass: 'text-white' },
            2: { class: 'bg-warning', textClass: 'text-dark' },
            3: { class: 'bg-info', textClass: 'text-white' },
            4: { class: 'bg-primary', textClass: 'text-white' },
            5: { class: 'bg-success', textClass: 'text-white' }
        };
        
        const config = levelConfig[level];
        badge.classList.add(config.class, config.textClass);
        
        const levelNumber = badge.querySelector('.level-number');
        if (levelNumber) {
            levelNumber.textContent = level;
        }
    }

    getTotalActivitiesForLevel(objectiveId, level) {
        const assessmentSection = document.getElementById(`assessment-${objectiveId}-${level}`);
        if (assessmentSection) {
            return assessmentSection.querySelectorAll('.activity-rating').length / 4;
        }
        return 0;
    }

    getScoreColorClass(score) {
        if (score === 0) return 'bg-danger text-white';
        if (score < 0.5) return 'bg-warning text-dark';
        if (score < 0.8) return 'bg-info text-white';
        return 'bg-success text-white';
    }

    getCompletionColorClass(ratio) {
        if (ratio === 0) return 'bg-secondary text-white';
        if (ratio < 0.5) return 'bg-warning text-dark';
        if (ratio < 1) return 'bg-info text-white';
        return 'bg-success text-white';
    }

    getRatingValue(rating) {
        const ratingMap = {
            'N': 0,
            'P': 1/3,
            'L': 2/3,
            'F': 1
        };
        return ratingMap[rating] || 0;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new COBITAssessmentManager({{ $evalId }});
});
</script>

{{-- Custom CSS for better styling --}}
<style>
.objective-card {
    transition: transform 0.2s ease-in-out;
}

.objective-card:hover {
    transform: translateY(-5px);
}

.card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
}

.card-header {
    border-bottom: none;
}

.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
}

.btn-group .btn:last-child {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
}

.domain-filter.active {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.badge {
    font-size: 0.75rem;
}

.card-footer {
    border-top: 1px solid rgba(0,0,0,0.1);
}

.bg-light {
    background-color: #f8f9fa !important;
}

/* Assessment Interface Styling */
.capability-level-section {
    border-left: 3px solid #007bff;
    padding-left: 1rem;
    background-color: #f8f9fa;
    border-radius: 0.375rem;
}

.capability-level-section:not(:last-child) {
    margin-bottom: 1rem;
}

.rating-scale-info {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.375rem;
    border-left: 3px solid #007bff;
}

.rating-info {
    background-color: #f8f9fa;
    padding: 0.75rem;
    border-radius: 0.375rem;
    border-left: 2px solid #007bff;
}

.capability-score {
    font-weight: bold;
    transition: all 0.3s ease;
}

.activity-assessment {
    transition: all 0.2s ease;
}

.activity-assessment:hover {
    background-color: #e9ecef !important;
    border-color: #007bff !important;
}

.activity-score {
    font-size: 0.7rem;
    transition: all 0.3s ease;
}

.rating-slider .btn-group {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.rating-slider .btn-check:checked + .btn {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

.clear-rating {
    border-radius: 0;
    margin-left: 5px;
}

.clear-rating:hover {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

.activity-assessment .col-md-1 .badge {
    font-size: 1rem;
    padding: 0.5rem;
}

.capability-level-display .badge,
.capability-score-display .badge {
    transition: all 0.3s ease;
    font-weight: bold;
}

.practice-section {
    border-left: 3px solid #007bff;
    padding-left: 1rem;
    margin-left: 0.5rem;
}

.btn-group .btn-sm {
    font-size: 0.8rem;
    padding: 0.25rem 0.5rem;
}

/* Evidence/Notes section styling */
.evidence-notes-section {
    background-color: #f8f9fa;
    padding: 0.75rem;
    border-radius: 0.375rem;
    border-left: 2px solid #6c757d;
}

.evidence-notes-section .form-label {
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.evidence-notes {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    resize: vertical;
    min-height: 60px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.evidence-notes:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.evidence-notes::placeholder {
    color: #6c757d;
    font-style: italic;
}

/* Smooth animations */
@keyframes slideDown {
    from {
        opacity: 0;
        max-height: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        max-height: 1000px;
        transform: translateY(0);
    }
}

.assessment-section {
    overflow: hidden;
    transition: all 0.3s ease;
}

@media (max-width: 768px) {
    .activity-assessment .row {
        flex-direction: column;
    }
    
    .rating-slider {
        margin-top: 1rem;
    }
}
</style>
@endsection
