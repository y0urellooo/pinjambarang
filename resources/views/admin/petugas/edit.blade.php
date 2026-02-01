@extends('layouts.app')

@section('title', 'Edit Petugas')
@section('page_title', 'Edit Petugas')

@section('content')
<form action="{{ route('admin.petugas.update', $petugas->id) }}"
      method="POST"
      class="card">
    @csrf
    @method('PUT')

    <div class="card-body">
        <h3 class="mb-4">Edit Petugas</h3>

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

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</form>
@endsection
