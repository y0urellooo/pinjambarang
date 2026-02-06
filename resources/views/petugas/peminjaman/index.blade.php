@extends('layouts.app')

@section('title', 'Data Peminjaman')
@section('page_title', 'Data Peminjaman')

@section('content')
{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Data Peminjaman Barang</h4>
        <small class="text-muted">
            Kelola pengajuan, persetujuan, dan pengembalian barang
        </small>
    </div>
</div>

{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm">
    <i class="bi bi-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show shadow-sm">
    <i class="bi bi-x-circle me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- TABLE CARD --}}
<div class="card border-0 shadow-lg rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-white text-center">
                    <tr>
                        <th width="60">No</th>
                        <th class="text-start">Peminjam</th>
                        <th class="text-start">Alat</th>
                        <th>Jumlah</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Lama</th>
                        <th>Status</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @forelse($peminjamans as $item)
                        @php
                            $lama = \Carbon\Carbon::parse($item->tanggal_pinjam)
                                ->diffInDays(\Carbon\Carbon::parse($item->tanggal_kembali));
                        @endphp

                        <tr>
                            <td class="fw-semibold">{{ $loop->iteration }}</td>

                            <td class="text-start">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:34px;height:34px;">
                                        {{ strtoupper(substr($item->user->name ?? '-', 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold">
                                        {{ $item->user->name ?? '-' }}
                                    </span>
                                </div>
                            </td>

                            <td class="text-start">
                                <span class="fw-semibold">
                                    {{ $item->alat->nama_alat ?? '-' }}
                                </span>
                            </td>

                            <td>{{ $item->jumlah_pinjam }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                            </td>

                            <td class="fw-semibold">
                                {{ $lama }} hari
                            </td>

                            <td>
                                @if($item->status === 'menunggu')
                                    <span class="badge rounded-pill bg-warning text-dark px-3">
                                        Menunggu
                                    </span>
                                @elseif($item->status === 'dipinjam')
                                    <span class="badge rounded-pill bg-primary px-3">
                                        Dipinjam
                                    </span>
                                @elseif($item->status === 'dikembalikan')
                                    <span class="badge rounded-pill bg-success px-3">
                                        Dikembalikan
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-danger px-3">
                                        Ditolak
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{-- MENUNGGU --}}
                                @if($item->status === 'menunggu')
                                    <form action="{{ route('petugas.peminjaman.approve', $item->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm rounded-pill px-3">
                                            <i class="bi bi-check-lg me-1"></i> Setujui
                                        </button>
                                    </form>

                                    <form action="{{ route('petugas.peminjaman.reject', $item->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-sm rounded-pill px-3">
                                            <i class="bi bi-x-lg me-1"></i> Tolak
                                        </button>
                                    </form>

                                {{-- DIPINJAM --}}
                                @elseif($item->status === 'dipinjam')
                                    <form action="{{ route('petugas.peminjaman.kembalikan', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Barang sudah dikembalikan?')">
                                        @csrf
                                        <button class="btn btn-primary btn-sm rounded-pill px-3">
                                            <i class="bi bi-arrow-repeat me-1"></i> Kembalikan
                                        </button>
                                    </form>

                                {{-- LAINNYA --}}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-muted py-5 text-center">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Tidak ada data peminjaman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
