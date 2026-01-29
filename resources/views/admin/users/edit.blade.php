@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="card">
    @csrf
    @method('PUT')

        <div class="card-body">
            <h3 class="mb-4">Edit User</h3>

            {{-- NAMA --}}
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}">

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
                    value="{{ old('email', $user->email) }}">

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">
                <label class="form-label">Password (Opsional)</label>
                <input type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukkan password baru">

                <small class="text-muted">
                    Kosongkan jika tidak ingin mengubah password
                </small>

                @error('password')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- ROLE --}}
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role"
                    class="form-select @error('role') is-invalid @enderror">

                    <option value="admin" {{ old('role', $user->role)=='admin'?'selected':'' }}>
                        Admin
                    </option>
                    <option value="petugas" {{ old('role', $user->role)=='petugas'?'selected':'' }}>
                        Petugas
                    </option>
                    <option value="peminjam" {{ old('role', $user->role)=='peminjam'?'selected':'' }}>
                        Peminjam
                    </option>
                </select>

                @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </form>
@endsection