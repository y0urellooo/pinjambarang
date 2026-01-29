@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card col-md-6">
    <div class="card-body">
        <h3 class="mb-3">Tambah Kategori</h3>

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan nama kategori">
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection