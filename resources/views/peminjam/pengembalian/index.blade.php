@extends('layouts.app')

@section('title', 'Pengembalian & Denda')
@section('page_title', 'Pengembalian & Denda')

@section('content')

<h3 class="mb-4">Riwayat Pengembalian</h3>

<div class="card">
    <div class="card-body p-0">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mb-0">
            <thead class="table-dark text-center align-middle">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali Rencana</th>
                    <th>Tgl Kembali Aktual</th>
                    <th>Denda (Rp)</th>
                    <th>Status Bayar</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                @forelse($pengembalians as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    {{-- FOTO --}}
                    <td>
                        @if($item->peminjaman->alat->foto)
                        <img src="{{ asset('foto_alat/' . $item->peminjaman->alat->foto) }}" width="50" class="img-thumbnail">
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>{{ $item->peminjaman->alat->nama_alat }}</td>
                    <td>{{ $item->peminjaman->alat->jumlah_pinjam }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d M Y') }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali_rencana)->format('d M Y') }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                    </td>

                    <td>{{ number_format($item->denda) }}</td>

                    <!-- Status Bayar -->
                    <td>
                        <span class="badge {{ $item->status_bayar === 'lunas' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($item->status_bayar) }}
                        </span>
                    </td>

                    <!-- Aksi -->
                    <td>
                        @if($item->status_bayar === 'belum')
                        <form action="{{ route('peminjam.pengembalian.bayar', $item->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-sm">Bayar Sekarang</button>
                        </form>
                        @else
                        <span class="badge bg-success">Sudah Dibayar</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-muted">Belum ada pengembalian dengan denda</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection