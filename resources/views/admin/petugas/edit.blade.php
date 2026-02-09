@extends('layouts.app')

@section('title', 'Edit Petugas')
@section('page_title', 'Edit Petugas')

@section('content')
<form action="{{ route('admin.petugas.update', $petugas->id) }} enc"
    method="POST"
    class="card"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card-body">
        <h3 class="mb-4">Edit Petugas</h3>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            @if($petugas->foto)
            <div class="mb-2">
                <img src="{{ asset('foto_petugas/' . $petugas->foto) }}" width="100" class="rounded">
            </div>
            @endif
            <input type="file"
                name="foto"
                class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $petugas->name) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $petugas->email) }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">
                Password <small class="text-muted">(Opsional)</small>
            </label>
            <input type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Masukkan password baru">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-outline-primary">Update</button>
        <a href="{{ route('admin.petugas.index') }}" class="btn btn-outline-secondary">
            Kembali
        </a>
    </div>
</form>
@endsection