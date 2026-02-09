@extends('layouts.app')

@section('title', 'Bayar Denda')
@section('page_title', 'Bayar Denda')

@section('content')
<h3 class="mb-4">Bayar Denda</h3>

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
    <div class="card-body">
        <h5 class="mb-3">Peminjaman: <strong>{{ $pengembalian->peminjaman->alat->nama_alat }}</strong></h5>
        <p>Jumlah Pinjam: {{ $pengembalian->peminjaman->jumlah_pinjam }}</p>
        <p>Tanggal Pinjam: {{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d M Y') }}</p>
        <p>
            Tanggal Kembali Rencana:
            {{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_kembali_rencana)->format('d M Y') }}
        </p>

        <p>
            Tanggal Kembali Aktual:
            {{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali_aktual)->format('d M Y') }}
        </p>

        <form method="POST" action="{{ route('peminjam.pembayaran.update', $pengembalian->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Total Denda (Rp)</label>
                <input type="number" class="form-control" value="{{ $pengembalian->denda }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Bayar (Rp)</label>
                <input type="number" name="bayar" class="form-control" value="{{ $pengembalian->denda }}" min="{{ $pengembalian->denda }}" required>
                <small class="text-muted">Masukkan nominal yang ingin dibayarkan (minimal sama dengan total denda).</small>
            </div>

            <button class="btn btn-success">Bayar Denda</button>
            <a href="{{ route('peminjam.peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
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