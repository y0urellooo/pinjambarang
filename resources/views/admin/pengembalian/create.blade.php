@extends('layouts.app')

@section('title', 'Pengembalian')

@section('content')
<form action="{{ route('admin.pengembalian.store', $peminjaman->id) }}"
      method="POST" class="card">
    @csrf
    <div class="card-body">

        <h4 class="mb-4">Pengembalian Barang</h4>

        <p><strong>Peminjam:</strong> {{ $peminjaman->user->name }}</p>
        <p><strong>Alat:</strong> {{ $peminjaman->alat->nama_alat }}</p>

        <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali"
                   class="form-control" required>
        </div>

        <button class="btn btn-success">Proses Pengembalian</button>
        <a href="{{ route('admin.peminjaman.index') }}"
           class="btn btn-secondary">Batal</a>

    </div>
</form>
@endsection
