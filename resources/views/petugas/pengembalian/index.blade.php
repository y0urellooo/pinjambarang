@extends('layouts.app')

@section('title', 'Data Pengembalian')
@section('page_title', 'Data Pengembalian')

@section('content')
<h5 class="fw-semibold mb-3">Riwayat Pengembalian</h5>

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
            <thead class="table-primary text-center">
                <tr class="align-middle">
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali Rencana</th>
                    <th>Tgl Kembali Aktual</th>
                    <th>Kondisi</th>
                    <th>Denda (Rp)</th>
                    <th>Status Bayar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($pengembalians as $item)
                <tr>
                    <td>{{ $pengembalians->firstItem() + $loop->index }}</td>
                    <td>{{ $item->peminjaman->user->name ?? '-' }}</td>
                    <td>{{ $item->peminjaman->alat->nama_alat ?? '-' }}</td>
                    <td>{{ $item->peminjaman->jumlah_pinjam }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali_rencana)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali_aktual)->format('d M Y') }}</td>
                    <td>
                        @if($item->kondisi === 'baik')
                            <span class="badge bg-success">Baik</span>
                        @elseif($item->kondisi === 'rusak')
                            <span class="badge bg-warning text-dark">Rusak</span>
                        @elseif($item->kondisi === 'hilang')
                            <span class="badge bg-danger">Hilang</span>
                        @endif
                    </td>
                    <td>{{ number_format($item->denda, 0, ',', '.') }}</td>

                    {{-- Status Bayar (petugas hanya lihat badge) --}}
                    <td>
                        @if($item->status_bayar === 'belum')
                            <span class="badge bg-danger">Belum Dibayar</span>
                        @else
                            <span class="badge bg-success">Sudah Dibayar</span>
                        @endif
                    </td>

                    {{-- Status pengembalian --}}
                    <td>
                        <span class="badge bg-primary">Dikembalikan</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-muted py-4">
                        Belum ada data pengembalian
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- pagination -->
        <x-pagination :paginator="$pengembalians" />
    </div>
</div>
@endsection
