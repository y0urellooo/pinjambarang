@extends('layouts.dashboard')

@section('title', 'Manajemen User')

@section('content')
<h2>Manajemen User</h2>

<a href="{{ route('admin.users.create') }}" class="btn">+ Tambah User</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ ucfirst($user->role) }}</td>
        <td>
            <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>

            <form action="{{ route('admin.users.destroy', $user->id) }}"
                  method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus user?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
