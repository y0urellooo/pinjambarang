@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')
@section('page_title', 'Peminjaman')

@section('content')
<h3 class="mb-4">Ajukan Peminjaman</h3>

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
                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                    </td>

                    <td>
                        <span class="fw-semibold">{{ $lama }} hari</span>
                    </td>
                    <td>
                        <span class="badge 
                {{ $item->status === 'menunggu' ? 'bg-warning' : 
                   ($item->status === 'dipinjam' ? 'bg-primary' : 'bg-success') }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>
                        @if($item->status === 'menunggu')
                        <form action="{{ route('peminjam.peminjaman.cencel', $item->id) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Batalkan pengajuan peminjaman?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Batalkan
                            </button>
                        </form>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada peminjaman
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- notif 3 detik -->
@if (session('error'))
<script>
    setTimeout(() => {
        const alert = document.getElementById('error-alert');
        if (alert) alert.remove();
    }, 3000);
</script>
@endif

@if (session('success'))
<script>
    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.add('fade');
            alert.classList.remove('show');
            alert.remove();
        }
    }, 3000);
</script>
@endif
@endsection