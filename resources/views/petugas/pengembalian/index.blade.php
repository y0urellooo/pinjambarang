@extends('layouts.app')

@section('title', 'Data Pengembalian')
@section('page_title', 'Data Pengembalian')

@section('content')
<h5 class="fw-semibold mb-3">Riwayat Pengembalian</h5>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($pengembalians as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->peminjaman->user->name ?? '-' }}</td>
                    <td>{{ $item->peminjaman->alat->nama_alat ?? '-' }}</td>
                    <td>{{ $item->peminjaman->jumlah_pinjam }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                    <td class="fw-semibold">
                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                    </td>
                    <td>
                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i> Dikembalikan
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted py-4">
                        Belum ada data pengembalian
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection