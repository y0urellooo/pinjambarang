@extends('layouts.app')

@section('title', 'Pengembalian & Denda')
@section('page_title', 'Pengembalian & Denda')

@section('content')

<h3 class="mb-4">Riwayat Pengembalian</h3>

<div class="card">
    <div class="card-body p-0">

        {{-- ALERT --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-bordered mb-0">
            <thead class="table-primary text-center align-middle">
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
                    <td>{{ $pengembalians->firstItem() + $loop->index }}</td>

                    {{-- FOTO --}}
                    <td>
                        @if($item->peminjaman->alat->foto)
                        <img src="{{ asset('foto_alat/' . $item->peminjaman->alat->foto) }}" width="50" class="img-thumbnail">
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>{{ $item->peminjaman->alat->nama_alat }}</td>
                    <td>{{ $item->peminjaman->jumlah_pinjam }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali_rencana)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>
                    <td>{{ number_format($item->denda) }}</td>

                    <!-- Status Bayar -->
                    <td>
                        <span class="badge {{ $item->status_bayar === 'lunas' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($item->status_bayar) }}
                        </span>
                    </td>

                    <!-- Aksi -->
                    <td>
                        @if($item->status_bayar !== 'lunas')
                        <form action="{{ route('peminjam.pengembalian.bayar', $item->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-primary btn-sm">Bayar Sekarang</button>
                        </form>
                        @else
                        <span class="badge bg-success">Sudah Dibayar</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-muted">Belum ada pengembalian dengan denda</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- paginate -->
        <x-pagination :paginator="$pengembalians" />
    </div>
</div>

{{-- Optional: auto-hide alert --}}
<script>
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000);
</script>

@endsection
