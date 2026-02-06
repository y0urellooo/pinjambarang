@extends('layouts.app')

@section('title', 'Pengembalian')
@section('page_title', 'Pengembalian Alat')

@section('content')
<h3 class="mb-4">Pengembalian Alat</h3>

@if (session('success'))
<div class="alert alert-success" id="success-alert">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
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
                    <th>Tgl Kembali</th>
                    <th>Lama Hari</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($peminjamans as $item)
                @php
                    $lama = \Carbon\Carbon::parse($item->tanggal_pinjam)
                        ->diffInDays(\Carbon\Carbon::parse($item->tanggal_kembali));
                @endphp

                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->alat->nama_alat }}</td>
                    <td>{{ $item->jumlah_pinjam }}</td>

                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>

                    <td><span class="fw-semibold">{{ $lama }} hari</span></td>

                    <td>
                        <span class="badge
                            {{ $item->status === 'dipinjam' ? 'bg-primary' : 'bg-success' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>

                    <td>
                        @if ($item->status === 'dipinjam')
                        <form action="{{ route('peminjam.pengembalian.store', $item->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin mengembalikan alat ini?')">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success btn-sm">
                                Kembalikan
                            </button>
                        </form>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Tidak ada alat yang sedang dipinjam
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- auto hide notif --}}
<script>
setTimeout(() => {
    document.getElementById('success-alert')?.remove();
    document.getElementById('error-alert')?.remove();
}, 3000);
</script>
@endsection
