@extends('layouts.dashboard')

@section('title', 'Edit Kategori')

@section('content')
<h2>Edit Kategori</h2>

<form method="POST" action="{{ route('admin.kategori.update', $kategori->id) }}">
    @csrf
    @method('PUT')

    <label>Nama Kategori</label>
    <input type="text" name="nama" value="{{ $kategori->nama }}" required>

    <label>Deskripsi</label>
    <textarea name="deskripsi">{{ $kategori->deskripsi }}</textarea>

    <br><br>
    <button type="submit">Update</button>
    <a href="{{ route('admin.kategori.index') }}">Kembali</a>
</form>
@endsection
