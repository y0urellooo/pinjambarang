@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')
@section('page_title', 'Tambah Peminjaman')

@section('content')
<h3 class="mb-4">Ajukan Peminjaman</h3>

<div class="card">
    <div class="card-body">
        <form method="POST" 
              action="{{ route('peminjam.peminjaman.store', $alat->id) }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Alat</label>
                <input type="text" class="form-control" 
                       value="{{ $alat->nama_alat }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" 
                       name="tanggal_pinjam"
                       class="form-control @error('tanggal_pinjam') is-invalid @enderror">

                @error('tanggal_pinjam')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Kembali</label>
                <input type="date" 
                       name="tanggal_kembali"
                       class="form-control @error('tanggal_kembali') is-invalid @enderror">

                @error('tanggal_kembali')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success">Ajukan</button>
            <a href="{{ route('peminjam.alat.index') }}" 
               class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
