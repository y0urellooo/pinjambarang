@extends('layouts.app')

@section('title', 'Data Peminjaman')
@section('page_title', 'Peminjaman')

@section('content')
<h3 class="mb-4">Data Peminjaman</h3>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->alat->nama_alat }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>
                        <span class="badge
                    {{ $item->status == 'menunggu' ? 'bg-warning' :
                       ($item->status == 'dipinjam' ? 'bg-primary' : 'bg-success') }}">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada data peminjaman
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection