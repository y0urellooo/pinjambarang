@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
<h2>Edit User</h2>

<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <label>Nama</label>
    <input type="text" name="name" value="{{ $user->name }}" required>

    <label>Email</label>
    <input type="email" name="email" value="{{ $user->email }}" required>

    <label>Password (opsional)</label>
    <input type="password" name="password">

    <label>Role</label>
    <select name="role" required>
        <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
        <option value="petugas" {{ $user->role=='petugas'?'selected':'' }}>Petugas</option>
        <option value="peminjam" {{ $user->role=='peminjam'?'selected':'' }}>Peminjam</option>
    </select>

    <br><br>
    <button type="submit">Update</button>
    <a href="{{ route('admin.users.index') }}">Kembali</a>
</form>
@endsection
