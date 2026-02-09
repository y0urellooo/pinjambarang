@extends('layouts.app')

@section('title', 'Proses Pengembalian')
@section('page_title', 'Proses Pengembalian')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('petugas.pengembalian.store', $peminjaman->id) }}" method="POST">
            @csrf

            {{-- TANGGAL RENCANA --}}
            <div class="mb-3">
                <label class="form-label">Tanggal Kembali (Rencana)</label>
                <div class="form-control bg-light">
                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana)->format('d M Y') }}
                </div>
            </div>

            {{-- TANGGAL AKTUAL --}}
            <div class="mb-3">
                <label class="form-label">Tanggal Kembali (Aktual)</label>
                <input type="date"
                       name="tanggal_kembali_aktual"
                       class="form-control"
                       required>
            </div>

            {{-- KONDISI --}}
            <div class="mb-3">
                <label class="form-label">Kondisi Barang</label>
                <select name="kondisi" class="form-control" required>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>

            {{-- CATATAN --}}
            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="catatan" class="form-control" rows="3"></textarea>
            </div>

            {{-- DENDA MANUAL --}}
            <div class="mb-3">
                <label class="form-label">Denda (Rp)</label>
                <input type="number"
                       name="denda"
                       class="form-control"
                       placeholder="Masukkan nominal denda kondisi barang"
                       min="0">
            </div>

            <button class="btn btn-success">Simpan Pengembalian</button>
            <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
