@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<form method="POST" action="{{ route('admin.users.store') }}" class="card">
    @csrf

    <div class="card-body">
        <h3 class="mb-4">Tambah User</h3>

        {{-- NAMA --}}
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                placeholder="Masukkan nama user">

            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                placeholder="Masukkan email">

            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Masukkan password">

            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- ROLE --}}
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role"
                class="form-select @error('role') is-invalid @enderror">

                <option value="">-- Pilih Role --</option>

                @if(auth()->user()->role !== 'admin')
                <option value="admin" {{ old('role')=='admin'?'selected':'' }}>
                    Admin
                </option>
                @endif

                <option value="petugas" {{ old('role')=='petugas'?'selected':'' }}>
                    Petugas
                </option>

                <option value="peminjam" {{ old('role')=='peminjam'?'selected':'' }}>
                    Peminjam
                </option>
            </select>

            @error('role')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </div>
</form>
@endsection