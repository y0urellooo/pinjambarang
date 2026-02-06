@extends('layouts.app')

@section('title', 'Data Peminjaman')
@section('page_title', 'Data Peminjaman')

@section('content')
    <h5 class="fw-semibold mb-3">Data Peminjaman Barang</h5>

    {{-- alert --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

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
                        <th>Lama</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @forelse($peminjamans as $item)
                        @php
                            $lama = \Carbon\Carbon::parse($item->tanggal_pinjam)
                                ->diffInDays(\Carbon\Carbon::parse($item->tanggal_kembali));
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ $item->alat->nama_alat ?? '-' }}</td>
                            <td>{{ $item->jumlah_pinjam }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>
                            <td class="fw-semibold">{{ $lama }} hari</td>

                            <td>
                                @if($item->status === 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>

                                @elseif($item->status === 'dipinjam')
                                    <span class="badge bg-primary">Dipinjam</span>

                                @elseif($item->status === 'pengajuan_kembali')
                                    <span class="badge bg-info text-dark">Menunggu Verifikasi</span>

                                @elseif($item->status === 'dikembalikan')
                                    <span class="badge bg-success">Dikembalikan</span>

                                @elseif($item->status === 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>

                            <td>
                                {{-- MENUNGGU --}}
                                @if($item->status === 'menunggu')
                                    <form action="{{ route('petugas.peminjaman.approve', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            Setujui
                                        </button>
                                    </form>

                                    <form action="{{ route('petugas.peminjaman.reject', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">
                                            Tolak
                                        </button>
                                    </form>

                                    {{-- DIPINJAM --}}
                                @elseif($item->status === 'dipinjam')
                                    <span class="text-muted">Menunggu pengembalian</span>

                                    {{-- PENGAJUAN KEMBALI --}}
                                @elseif($item->status === 'pengajuan_kembali')
                                    <a href="{{ route('petugas.pengembalian.create', $item->id) }}" class="btn btn-warning btn-sm">
                                        Proses Pengembalian
                                    </a>

                                    {{-- DIKEMBALIKAN / DITOLAK --}}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-muted py-4">
                                Tidak ada data peminjaman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection