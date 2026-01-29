@extends('layouts.app')

@section('page_title', 'Edit Kategori')

@section('content')

<div class="card col-md-6">
    <div class="card-body">
        <h3 class="mb-4">Edit Kategori</h3>
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text"
                       name="nama_kategori"
                       class="form-control"
                       value="{{ $kategori->nama_kategori }}"
                       required>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.kategori.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
