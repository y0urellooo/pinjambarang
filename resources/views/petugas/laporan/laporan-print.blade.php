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
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark text-center">
                <tr class="align-middle">
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Foto</th>
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali Rencana</th>
                    <th>Tgl Kembali Aktual</th>
                    <th>Denda</th>
                    <th>Status Bayar</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($pengembalians as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->peminjaman->user->name ?? '-' }}</td>
                    {{-- FOTO --}}
                    <td>
                        @if($item->peminjaman->alat->foto)
                        <img src="{{ asset('foto_alat/' . $item->peminjaman->alat->foto) }}" width="50" class="img-thumbnail">
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item->peminjaman->alat->nama_alat ?? '-' }}</td>
                    <td>{{ $item->peminjaman->jumlah_pinjam ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali_rencana)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali_aktual)->format('d M Y') }}</td>
                    <td>Rp. {{ number_format($item->denda) }}</td>

                    <!-- Status Bayar -->
                    <td>
                        <span class="badge {{ $item->status_bayar === 'lunas' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($item->status_bayar) }}
                        </span>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-4 text-muted">
                        Tidak ada data pengembalian
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection