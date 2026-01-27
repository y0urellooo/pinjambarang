@extends('layouts.app')

@section('page_title', 'Edit Kategori')

@section('content')
<h3 class="mb-4">Edit Kategori</h3>

<div class="card col-md-6">
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
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
            <a href="{{ route('kategori.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
