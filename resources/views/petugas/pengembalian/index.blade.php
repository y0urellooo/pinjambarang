@extends('layouts.app')

@section('title', 'Data Pengembalian')
@section('page_title', 'Data Pengembalian')

@section('content')
<h3 class="mb-4">Riwayat Pengembalian</h3>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Tgl Kembali</th>
                    <th>Kondisi</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengembalians as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->peminjaman->user->name }}</td>
                    <td>{{ $item->peminjaman->alat->nama_alat }}</td>
                    <td>{{ $item->tanggal_kembali }}</td>
                    <td>
                        <span class="badge bg-{{
                            $item->kondisi === 'baik' ? 'success' :
                            ($item->kondisi === 'rusak' ? 'danger' : 'primary')
                        }}">
                            {{ ucfirst($item->kondisi) }}
                        </span>
                    </td>
                    <td>{{ $item->catatan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada data pengembalian
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
