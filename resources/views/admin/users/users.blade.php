@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">User List</h2>

    {{-- Data Table --}}
    <div class="card">
        <div class="card-header bg-secondary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Daftar Akun</h6>
            </div>
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

        @if($users->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-database fa-3x text-muted mb-3"></i>
                <p class="h5 text-muted">Belum ada akun terdaftar</p>
            </div>
        @else
            <div class="table-responsive" style="max-height: 500px">
                <table class="table table-striped table-hover table-sticky mb-0">
                    <thead>
                        <tr>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Role</th>
                            <th class="py-3">Organisasi</th>
                            <th class="py-3">Jabatan</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr>
                                <td class="align-middle">{{ $u->name }}</td>
                                <td class="align-middle">{{ $u->email }}</td>
                                <td class="align-middle">{{ $u->role }}</td>
                                <td class="align-middle">{{ $u->organisasi }}</td>
                                <td class="align-middle">{{ $u->jabatan }}</td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-outline-primary btn-sm me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $u->id }}">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                    <form action="{{ route('home', $u->id) }}" method="POST" 
                                          style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @foreach($users as $u)
                        <!-- Modal -->
                        <div class="modal fade" id="editModal{{ $u->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $u->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form method="POST" action="{{ route('admin.users.update', $u->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $u->id }}">Edit User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Name -->
                                            <div class="mb-3">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="name" value="{{ $u->name }}" required>
                                            </div>
                                            <!-- Email -->
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" value="{{ $u->email }}" required>
                                            </div>
                                            <!-- Role -->
                                            <div class="mb-3">
                                                <label class="form-label">Role</label>
                                                <select name="role" class="form-select">
                                                    <option value="user" {{ $u->role == 'user' ? 'selected' : '' }}>User</option>
                                                    <option value="admin" {{ $u->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="pic" {{ $u->role == 'pic' ? 'selected' : '' }}>PIC</option>
                                                </select>
                                            </div>
                                            <!-- Jabatan -->
                                            <div class="mb-3">
                                                <label class="form-label">Jabatan</label>
                                                <input type="text" class="form-control" name="jabatan" value="{{ $u->jabatan }}">
                                            </div>
                                            <!-- Organisasi -->
                                            <div class="mb-3">
                                                <label class="form-label">Organisasi</label>
                                                <input type="text" class="form-control" name="organisasi" value="{{ $u->organisasi }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection