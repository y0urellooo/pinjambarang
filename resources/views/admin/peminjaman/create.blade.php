@extends('layouts.app')

@section('title', 'Tambah Peminjaman')
@section('page_title', 'Tambah Peminjaman')

@section('content')

<form action="{{ route('admin.peminjaman.store') }}" method="POST" class="card">
    @csrf
    <div class="card-body">

        <h3 class="mb-4">Tambah Peminjaman</h3>

        <div class="mb-3">
            <label class="form-label">Peminjam</label>
            <select name="user_id" class="form-select">
                <option value="">-- Pilih Peminjam --</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('user_id')==$user->id)>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
            @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alat</label>
            <select name="alat_id" class="form-select">
                <option value="">-- Pilih Alat --</option>
                @foreach ($alats as $alat)
                <option value="{{ $alat->id }}" @selected(old('alat_id')==$alat->id)>
                    {{ $alat->nama_alat }}
                </option>
                @endforeach
            </select>
            @error('alat_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam"
                class="form-control"
                value="{{ old('tanggal_pinjam') }}">
            @error('tanggal_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</form>
@endsection