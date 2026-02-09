@extends('layouts.app')

@section('title', 'Data Peminjaman')
@section('page_title', 'Peminjaman')

@section('content')
<h3 class="mb-4">Data Peminjaman</h3>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Foto Alat</th>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali Rencana</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $item)
                <tr class="text-center align-middle">
                    <td>{{ $peminjamans->firstItem() + $loop->index }}</td>
                    <td>{{ $item->user->name }}</td>

                    {{-- FOTO ALAT --}}
                    <td>
                        @if($item->alat->foto)
                        <img src="{{ asset('foto_alat/' . $item->alat->foto) }}"
                            width="50" height="50" class="img-thumbnail" alt="{{ $item->alat->nama_alat }}">
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>{{ $item->alat->nama_alat }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali_rencana)->format('d M Y') }}</td>
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
                    <td colspan="8" class="text-center text-muted">
                        Belum ada data peminjaman
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- pagination -->
        <x-pagination :paginator="$peminjamans" />

    </div>
</div>
@endsection