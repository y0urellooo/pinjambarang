@extends('layouts.app')

@section('title', 'Data Peminjaman')
@section('page_title', 'Data Peminjaman')

@section('content')
<h3 class="mb-4">Data Peminjaman</h3>

<a href="{{ route('admin.peminjaman.create') }}" class="btn btn-primary mb-3">
    + Tambah Peminjaman
</a>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjamans as $peminjaman)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peminjaman->user->name }}</td>
                    <td>{{ $peminjaman->alat->nama_alat ?? '-' }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $peminjaman->tanggal_kembali ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{
                            $peminjaman->status === 'dipinjam' ? 'warning' :
                            ($peminjaman->status === 'dikembalikan' ? 'success' :
                            ($peminjaman->status === 'rusak' ? 'danger' :
                            'secondary'))
                        }}">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </td>

                    <!-- aksi -->
                    <td>
                        @if ($peminjaman->status === 'dipinjam')
                        <a href="{{ route('admin.peminjaman.edit', $peminjaman->id) }}"
                            class="btn btn-warning btn-sm">
                            Koreksi
                        </a>

                        <a href="{{ route('admin.pengembalian.create', $peminjaman->id) }}"
                            class="btn btn-success btn-sm">
                            Kembalikan
                        </a>

                        @elseif ($peminjaman->status === 'dikembalikan')
                        <a href="{{ route('admin.peminjaman.edit', $peminjaman->id) }}"
                            class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.peminjaman.destroy', $peminjaman->id) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus data?')">
                                Hapus
                            </button>
                        </form>

                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada data peminjaman
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection