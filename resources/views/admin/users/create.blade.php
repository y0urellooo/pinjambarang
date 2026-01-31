@extends('layouts.dashboard')

@section('title', 'Tambah User')

@section('content')
<h2>Tambah User</h2>

<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    <label>Nama</label>
    <input type="text" name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Role</label>
    <select name="role" required>
        <option value="admin">Admin</option>
        <option value="petugas">Petugas</option>
        <option value="peminjam">Peminjam</option>
    </select>

    <br><br>
    <button type="submit">Simpan</button>
    <a href="{{ route('admin.users.index') }}">Kembali</a>
</form>
@endsection
