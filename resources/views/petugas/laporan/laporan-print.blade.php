@extends('layouts.app')

@section('title', 'Cetak Laporan Pengembalian')
@section('page_title', 'Cetak Laporan Pengembalian')

@section('content')
<div class="container py-4">

    <h4 class="mb-4 text-center">📋 Laporan Pengembalian</h4>

    <button onclick="window.print()" class="btn btn-primary mb-3">
        <i class="bi bi-printer"></i> Cetak
    </button>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengembalians as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->peminjaman->user->name ?? '-' }}</td>
                    <td>{{ $item->peminjaman->alat->nama_alat ?? '-' }}</td>
                    <td>{{ $item->peminjaman->jumlah_pinjam }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>
                    <td><span class="badge rounded-pill bg-success px-3 py-2">Dikembalikan</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
