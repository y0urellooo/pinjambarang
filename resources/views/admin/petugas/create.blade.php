@extends('layouts.app')

@section('title', 'Tambah Petugas')
@section('page_title', 'Tambah Petugas')

@section('content')
<form action="{{ route('admin.petugas.store') }}" method="POST" class="card">
    @csrf

    <div class="card-body">
        <h3 class="mb-4">Tambah Petugas</h3>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Masukkan nama petugas">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="Masukkan email">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Masukkan password">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</form>
@endsection
