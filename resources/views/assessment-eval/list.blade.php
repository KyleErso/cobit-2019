@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container mx-auto p-6">
    {{-- Main Card --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">
                    <i class="fas fa-clipboard-list me-2"></i>
                    COBIT 2019 Assessments
                </h3>
                <form action="{{ route('assessment-eval.create') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light">
                        <i class="fas fa-plus me-2"></i>Create New Assessment
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <p class="mb-3 text-muted">
                Manage your COBIT 2019 capability assessments. Create new assessments or continue working on existing ones.
            </p>
        </div>
    </div>

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Assessments List --}}
    @if($evaluations->count() > 0)
        <div class="row">
            @foreach($evaluations as $evaluation)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold">
                                    <i class="fas fa-file-alt text-primary me-2"></i>
                                    Assessment #{{ $evaluation->eval_id }}
                                </h6>
                                <span class="badge bg-secondary">
                                    {{ $evaluation->activityEvaluations->count() }} activities
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted">
                                    <strong>Created:</strong> {{ $evaluation->created_at->format('M d, Y g:i A') }}
                                </small>
                                <br>
                                <small class="text-muted">
                                    <strong>Last Updated:</strong> {{ $evaluation->updated_at->format('M d, Y g:i A') }}
                                </small>
                            </div>
                            
                            @if($evaluation->activityEvaluations->count() > 0)
                                <div class="progress mb-3" style="height: 6px;">
                                    @php
                                        $achievementCounts = $evaluation->activityEvaluations->groupBy('level_achieved')->map->count();
                                        $total = $evaluation->activityEvaluations->count();
                                        $percentages = [
                                            'F' => round((($achievementCounts['F'] ?? 0) / $total) * 100, 1),
                                            'L' => round((($achievementCounts['L'] ?? 0) / $total) * 100, 1),
                                            'P' => round((($achievementCounts['P'] ?? 0) / $total) * 100, 1),
                                            'N' => round((($achievementCounts['N'] ?? 0) / $total) * 100, 1)
                                        ];
                                    @endphp
                                    @if($percentages['F'] > 0)
                                        <div class="progress-bar bg-success" style="width: {{ $percentages['F'] }}%" 
                                             title="Fully: {{ $achievementCounts['F'] ?? 0 }} ({{ $percentages['F'] }}%)"></div>
                                    @endif
                                    @if($percentages['L'] > 0)
                                        <div class="progress-bar bg-info" style="width: {{ $percentages['L'] }}%" 
                                             title="Largely: {{ $achievementCounts['L'] ?? 0 }} ({{ $percentages['L'] }}%)"></div>
                                    @endif
                                    @if($percentages['P'] > 0)
                                        <div class="progress-bar bg-warning" style="width: {{ $percentages['P'] }}%" 
                                             title="Partial: {{ $achievementCounts['P'] ?? 0 }} ({{ $percentages['P'] }}%)"></div>
                                    @endif
                                    @if($percentages['N'] > 0)
                                        <div class="progress-bar bg-danger" style="width: {{ $percentages['N'] }}%" 
                                             title="None: {{ $achievementCounts['N'] ?? 0 }} ({{ $percentages['N'] }}%)"></div>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between text-center">
                                    <div>
                                        <div class="fw-bold text-success">{{ $achievementCounts['F'] ?? 0 }}</div>
                                        <small class="text-muted">Fully</small>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-info">{{ $achievementCounts['L'] ?? 0 }}</div>
                                        <small class="text-muted">Largely</small>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-warning">{{ $achievementCounts['P'] ?? 0 }}</div>
                                        <small class="text-muted">Partial</small>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-danger">{{ $achievementCounts['N'] ?? 0 }}</div>
                                        <small class="text-muted">None</small>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <i class="fas fa-clipboard text-muted mb-2" style="font-size: 2rem;"></i>
                                    <p class="text-muted mb-0">No activities evaluated yet</p>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('assessment-eval.show', $evaluation->eval_id) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>
                                    View Assessment
                                </a>
                                <button class="btn btn-danger btn-sm delete-assessment" 
                                        data-eval-id="{{ $evaluation->eval_id }}"
                                        title="Delete Assessment">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center py-5">
            <div class="card shadow-sm">
                <div class="card-body py-5">
                    <i class="fas fa-clipboard-list text-muted mb-3" style="font-size: 4rem;"></i>
                    <h5 class="text-muted mb-3">No Assessments Yet</h5>
                    <p class="text-muted mb-4">
                        You haven't created any COBIT 2019 assessments yet. Get started by creating your first assessment.
                    </p>
                    <form action="{{ route('assessment-eval.create') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Create Your First Assessment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-assessment');
    console.log('Found delete buttons:', deleteButtons.length);

    deleteButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            const evalId = this.getAttribute('data-eval-id');
            console.log('Delete button clicked for eval ID:', evalId);
            
            if (confirm(`Are you sure you want to delete Assessment #${evalId}? This action cannot be undone.`)) {
                try {
                    const response = await fetch(`/assessment-eval/${evalId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        showNotification('Assessment deleted successfully!', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showNotification(result.message || 'Failed to delete assessment', 'error');
                    }
                } catch (error) {
                    console.error('Delete error:', error);
                    showNotification('Failed to delete assessment', 'error');
                }
            }
        });
    });

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} alert-dismissible fade show position-fixed`;
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
});
</script>

<style>
.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-3px);
}

.progress {
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    transition: width 0.6s ease;
}

.btn-danger:hover {
    transform: scale(1.05);
    transition: transform 0.2s ease-in-out;
}
</style>
@endsection
