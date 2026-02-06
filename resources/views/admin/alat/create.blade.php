@extends('layouts.app')

@section('page_title', 'Tambah Alat')

@section('content')

<form action="{{ route('admin.alat.store') }}" method="POST" class="card" enctype="multipart/form-data">
    @csrf

    <div class="card-body">
        <h3 class="mb-4">Tambah Alat</h3>

        <!-- foto alat -->
        <div class="mb-3">
            <label class="form-label">Foto Alat</label>
            <input type="file" name="foto" class="form-control">
        </div>

        {{-- NAMA ALAT --}}
        <div class="mb-3">
            <label class="form-label">Nama Alat</label>
            <input type="text"
                name="nama_alat"
                class="form-control @error('nama_alat') is-invalid @enderror"
                value="{{ old('nama_alat') }}"
                placeholder="Masukkan nama alat">

            @error('nama_alat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- KATEGORI --}}
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori_id"
                class="form-select @error('kategori_id') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}"
                    {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
                @endforeach
            </select>

            @error('kategori_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- STOK --}}
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number"
                name="jumlah_alat"
                class="form-control @error('jumlah_alat') is-invalid @enderror"
                value="{{ old('jumlah_alat') }}"
                min="0"
                placeholder="Masukkan stok alat">

            @error('jumlah_alat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Kondisi -->
        <div class="mb-3">
            <label>Kondisi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</form>
@endsection
