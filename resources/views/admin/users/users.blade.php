@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">User List</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Jabatan</th>
                <th>Organisasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->jabatan }}</td>
                    <td>{{ $user->organisasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
