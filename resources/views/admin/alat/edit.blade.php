@extends('layouts.app')

@section('page_title', 'Edit Alat')

@section('content')

<form action="{{ route('admin.alat.update', $alat->id) }}"
    method="POST"
    class="card"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card-body">
        <h3 class="mb-4">Edit Alat</h3>

        <!-- foto alat -->
        <div class="mb-3">
            <label>Foto Alat</label><br>

            @if($alat->foto)
            <img src="{{ asset('storage/' . $alat->foto) }}" width="100" class="mb-2">
            @endif

            <input type="file" name="foto" class="form-control">
        </div>

        {{-- NAMA ALAT --}}
        <div class="mb-3">
            <label class="form-label">Nama Alat</label>
            <input type="text"
                name="nama_alat"
                class="form-control @error('nama_alat') is-invalid @enderror"
                value="{{ old('nama_alat', $alat->nama_alat) }}">

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
                @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}"
                    {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
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
                value="{{ old('jumlah_alat', $alat->jumlah_alat) }}"
                min="0">

            @error('jumlah_alat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- deskripsi -->
        <div class="mb-3">
            <textarea name="deskripsi" class="form-control" rows="3">
            {{ old('deskripsi', $alat->deskripsi) }}
            </textarea>

            @error('deskripsi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</form>
@endsection