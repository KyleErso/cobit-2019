@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Admin Dashboard – Kelola Kode Assessment</h2>

    {{-- Form Buat Kode Baru --}}
    <div class="card mb-4">
        <div class="card-header">Buat Kode Assessment Baru</div>
        <div class="card-body">
            <form action="{{ route('admin.assessments.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="kode_assessment" class="form-label">Kode Assessment</label>
                        <input type="text"
                               id="kode_assessment"
                               name="kode_assessment"
                               class="form-control @error('kode_assessment') is-invalid @enderror"
                               value="{{ old('kode_assessment') }}"
                               required>
                        @error('kode_assessment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="instansi" class="form-label">Instansi Default</label>
                        <input type="text"
                               id="instansi"
                               name="instansi"
                               class="form-control @error('instansi') is-invalid @enderror"
                               value="{{ old('instansi') }}"
                               required>
                        @error('instansi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2 d-flex align-items-end mb-3">
                        <button type="submit" class="btn btn-success w-100">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Daftar Kode --}}
    <div class="card">
        <div class="card-header">Daftar Kode Assessment</div>
        <div class="card-body p-0">
            @if($assessments->isEmpty())
                <p class="p-3 text-muted">Belum ada kode assessment.</p>
            @else
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Instansi</th>
                            <th>Dibuat Oleh (User-ID)</th>
                            <th>Waktu Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assessments as $a)
                            <tr>
                                <td>{{ $a->assessment_id }}</td>
                                <td>{{ $a->kode_assessment }}</td>
                                <td>{{ $a->instansi }}</td>
                                <td>{{ $a->user_id }}</td>
                                <td>{{ $a->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
