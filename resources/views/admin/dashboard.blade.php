@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Kelola Kode Assessment</h2>
    </div>

    {{-- Form Buat Kode Baru --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white py-3">
            <h6 class="m-0 font-weight-bold">Buat Kode Baru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.assessments.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="kode_assessment" class="form-label small text-muted">Kode Assessment</label>
                        <input type="text" id="kode_assessment" name="kode_assessment"
                               class="form-control form-control-lg @error('kode_assessment') is-invalid @enderror"
                               value="{{ old('kode_assessment') }}" required>
                        @error('kode_assessment')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-5">
                        <label for="instansi" class="form-label small text-muted">Instansi Default</label>
                        <input type="text" id="instansi" name="instansi"
                               class="form-control form-control-lg @error('instansi') is-invalid @enderror"
                               value="{{ old('instansi') }}" required>
                        @error('instansi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg h-100">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Form Cari Assessment by ID --}}
    <div class="card mb-4">
        <div class="card-header bg-success text-white py-3">
            <h6 class="m-0 font-weight-bold">Cari Assessment</h6>
        </div>
        <div class="card-body">
            <form method="GET" onsubmit="this.action='{{ url('admin/assessments') }}/'+this.elements.assessment_id.value">
                <div class="input-group">
                    <input type="number" name="assessment_id" 
                           class="form-control form-control-lg" 
                           placeholder="Masukkan Assessment ID"
                           required>
                    <button class="btn btn-success btn-lg" type="submit">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Daftar Kode --}}
    <div class="card">
        <div class="card-header bg-secondary text-white py-3">
            <h6 class="m-0 font-weight-bold">Daftar Kode Assessment</h6>
        </div>
        <div class="card-body p-0">
            @if($assessments->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-database fa-3x text-muted mb-3"></i>
                    <p class="h5 text-muted">Belum ada data assessment</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3">ID</th>
                                <th class="py-3">Kode</th>
                                <th class="py-3">Instansi</th>
                                <th class="py-3">Dibuat Pada</th>
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