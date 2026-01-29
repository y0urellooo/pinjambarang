@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="card col-md-6">
    <div class="card-body">

        <h3 class="mb-4">Tambah Kategori</h3>

        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="mb-2">Nama Kategori</label>
                <input type="text"
                    name="nama_kategori"
                    value="{{ old('nama_kategori') }}"
                    class="form-control @error('nama_kategori') is-invalid @enderror"
                    placeholder="Masukkan nama kategori">

                <!-- validasi -->
                @error('nama_kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection