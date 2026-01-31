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

        <div class="mb-3">
            <label>Kondisi Barang</label>
            <select name="kondisi" class="form-select" required>
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
                <option value="hilang">Hilang</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan"
                      class="form-control"
                      rows="3" placeholder="Masukkan catatan kondisi alat"></textarea>
        </div>

        <button class="btn btn-success">Proses Pengembalian</button>
        <a href="{{ route('admin.peminjaman.index') }}"
           class="btn btn-secondary">Batal</a>

    </div>
</form>
@endsection
