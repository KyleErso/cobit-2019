@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Alert Messages --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Kelola Kode Assessment</h2>

        {{-- Tombol untuk Cek Daftar Request --}}
        <a href="{{ url('admin/requests') }}" class="btn btn-info">
            <i class="fas fa-list me-1"></i> Cek Daftar Request
        </a>
    </div>

    {{-- Forms Grid --}}
    <div class="row g-4 mb-4">
        {{-- Create Form --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="m-0 font-weight-bold">Buat Kode Baru</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.assessments.index') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label for="kode_assessment" class="form-label small text-muted">Kode Assessment</label>
                                <input type="text" id="kode_assessment" name="kode_assessment"
                                    class="form-control @error('kode_assessment') is-invalid @enderror"
                                    value="{{ old('kode_assessment') }}" required>
                                @error('kode_assessment')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-5">
                                <label for="instansi" class="form-label small text-muted">Instansi Default</label>
                                <input type="text" id="instansi" name="instansi"
                                    class="form-control @error('instansi') is-invalid @enderror"
                                    value="{{ old('instansi') }}" required>
                                @error('instansi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-2 d-grid">
                                <button type="submit" class="btn btn-primary px-3 py-2">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Filter Form --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-secondary text-white py-3">
                    <h6 class="m-0 font-weight-bold">Filter Data</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.assessments.index') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" name="id" class="form-control" 
                                    placeholder="ID" value="{{ request('id') }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="kode_assessment" class="form-control" 
                                    placeholder="Kode" value="{{ request('kode_assessment') }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="instansi" class="form-control" 
                                    placeholder="Instansi" value="{{ request('instansi') }}">
                            </div>
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-outline-secondary px-3 py-2 flex-grow-1">
                                        <i class="fas fa-filter me-2"></i>Terapkan Filter
                                    </button>
                                    <a href="{{ route('admin.assessments.index') }}" class="btn btn-outline-danger px-3 py-2 flex-grow-1">
                                        <i class="fas fa-times me-2"></i>Reset Filter
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Summary --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle p-3">
                            <i class="fas fa-database fa-2x"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0">{{ $assessments->count() }}</h5>
                            <span class="text-muted small">Total Assessment</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded-circle p-3">
                            <i class="fas fa-calendar-plus fa-2x"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0">{{ $assessments->where('created_at', '>=', now()->subMonth())->count() }}</h5>
                            <span class="text-muted small">Bulan Ini</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info text-white rounded-circle p-3">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0">{{ $assessments->where('created_at', '>=', now()->subWeek())->count() }}</h5>
                            <span class="text-muted small">Minggu Ini</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning text-white rounded-circle p-3">
                            <i class="fas fa-sync fa-2x"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0">{{ $assessments->unique('instansi')->count() }}</h5>
                            <span class="text-muted small">Instansi Unik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="card">
        <div class="card-header bg-secondary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Daftar Kode Assessment</h6>
            </div>
        </div>
        <div class="card-body p-0">
            <style>
                .table-sticky thead th {
                    position: sticky;
                    top: -1px;
                    background: white;
                    z-index: 10;
                }
                .table-sticky {
                    border-collapse: separate;
                    border-spacing: 0;
                }
            </style>

            @if($assessments->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-database fa-3x text-muted mb-3"></i>
                    <p class="h5 text-muted">Belum ada data assessment</p>
                </div>
            @else
                <div class="table-responsive" style="max-height: 500px">
                    <table class="table table-striped table-hover table-sticky mb-0">
                        <thead>
                            <tr>
                                <th class="py-3">ID</th>
                                <th class="py-3">Kode</th>
                                <th class="py-3">Instansi</th>
                                <th class="py-3">Dibuat Pada</th>
                                <th class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assessments as $a)
                                <tr>
                                    <td class="align-middle">{{ $a->assessment_id }}</td>
                                    <td class="align-middle">
                                        <span class="badge bg-primary">{{ $a->kode_assessment }}</span>
                                    </td>
                                    <td class="align-middle">{{ $a->instansi }}</td>
                                    <td class="align-middle">
                                        {{ $a->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.assessments.show', $a->assessment_id) }}" 
                                           class="btn btn-outline-secondary px-3 py-2 btn-sm">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
