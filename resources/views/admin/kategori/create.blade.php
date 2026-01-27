@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')
<h2>Tambah Kategori</h2>

<form method="POST" action="{{ route('admin.kategori.store') }}">
    @csrf

    <label>Nama Kategori</label>
    <input type="text" name="nama" required>

    <label>Deskripsi</label>
    <textarea name="deskripsi"></textarea>

    <br><br>
    <button type="submit">Simpan</button>
    <a href="{{ route('admin.kategori.index') }}">Kembali</a>
</form>
@endsection
