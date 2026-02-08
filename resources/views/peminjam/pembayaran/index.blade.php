@extends('layouts.app')

@section('title', 'Pembayaran Denda')
@section('page_title', 'Pembayaran Denda')

@section('content')
<h3 class="mb-4">Daftar Denda</h3>

@if(session('success'))
<div class="alert alert-success" id="success-alert">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger" id="error-alert">
    {{ session('error') }}
</div>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali Rencana</th>
                    <th>Tgl Kembali Aktual</th>
                    <th>Denda (Rp)</th>
                    <th>Status Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($pengembalians as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->peminjaman->alat->nama_alat ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali_rencana)->format('d M Y') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal_kembali_aktual)->format('d M Y') }}
                    </td>
                    <td>{{ number_format($item->denda, 0, ',', '.') }}</td>
                    <td>
                        @if($item->status_bayar === 'lunas')
                        <span class="badge bg-success">Lunas</span>
                        @else
                        <span class="badge bg-danger">Belum</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status_bayar === 'belum')
                        <a href="{{ route('peminjam.pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm">
                            Bayar Denda
                        </a>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Belum ada denda</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<