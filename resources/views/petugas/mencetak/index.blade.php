@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">📋 Laporan Peminjaman</h5>
            <a href="{{ route('petugas.mencetak.cetak') }}" target="_blank" class="btn btn-primary btn-sm">
                <i class="bi bi-printer"></i> Cetak Semua
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mencetak as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_peminjam }}</td>
                                <td>
                                    <span class="badge rounded-pill 
                                        @if($item->status == 'dipinjam') bg-primary 
                                        @elseif($item->status == 'dikembalikan') bg-success 
                                        @else bg-warning text-dark @endif px-3 py-2">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">
                                    Tidak ada data peminjaman
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
