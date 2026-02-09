@extends('layouts.app')

@section('title', 'Laporan Pengembalian')
@section('page_title', 'Laporan Pengembalian')

@section('content')
<div class="container py-3">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center p-3 mt-2">
            <h5 class="mb-0 fw-semibold">Laporan Pengembalian</h5>

            {{-- Tombol Cetak --}}
            @if(request('tgl_awal') && request('tgl_akhir'))
            <a href="{{ route('petugas.laporan-cetak', request()->all()) }}"
                class="btn btn-success">
                <i class="bi bi-printer"></i> Cetak Laporan
            </a>
            @endif
        </div>

        {{-- FILTER --}}
        <div class="card-body border-bottom">
            <form method="GET">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" class="form-control"
                            value="{{ request('tgl_awal') }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" class="form-control"
                            value="{{ request('tgl_akhir') }}" required>
                    </div>

                    <div class="col-md-4 d-flex gap-2">
                        <button class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Tampilkan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- TABEL --}}
        <div class="table-responsive p-3 shadow-sm">
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
                        <td>{{ $pengembalians->firstName() + $loop->index }}</td>
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
                        <td colspan="10" class="py-4 text-muted">
                            Tidak ada data pengembalian
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- pagination -->
             <x-pagination :paginator="$pengembalians" />
        </div>
    </div>

</div>
@endsection