@extends('layouts.app')

@section('title', 'Proses Pengembalian')
@section('page_title', 'Proses Pengembalian')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('petugas.pengembalian.store', $peminjaman->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Tanggal Kembali Aktual</label>
                <input type="date" name="tanggal_kembali" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kondisi Barang</label>
                <select name="kondisi" class="form-control" required>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Denda (Rp)</label>
                <input type="number" name="denda" class="form-control" value="0">
            </div>

            <button class="btn btn-success">Simpan Pengembalian</button>
            <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
