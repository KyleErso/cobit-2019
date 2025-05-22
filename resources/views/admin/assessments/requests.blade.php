{{-- resources/views/admin/assessment/requests.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Pending Assessment Requests</h3>
    <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(empty($requests))
    <div class="text-center text-muted py-5">
      Tidak ada request pending saat ini.
    </div>
  @else
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th class="text-center py-2">#</th>
            <th class="py-2">User</th>
            <th class="py-2">Kode</th>
            <th class="py-2">Instansi</th>
            <th class="py-2">Requested At</th>
            <th class="text-center py-2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($requests as $idx => $r)
            <tr>
              <td class="text-center">{{ $idx }}</td>
              <td>{{ $r['username'] }} (ID: {{ $r['user_id'] }})</td>
              <td>{{ $r['kode'] }}</td>
              <td>{{ $r['instansi'] }}</td>
              <td>{{ $r['requested_at'] }}</td>
              <td class="text-center">
                <form method="POST" action="{{ route('admin.requests.approve', $idx) }}">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-success">
                    <i class="fas fa-check me-1"></i>Approve
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
@endsection
