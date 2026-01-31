@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')
@section('page_title', 'Peminjaman')

@section('content')
<h3 class="mb-4">Ajukan Peminjaman</h3>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->alat->nama_alat }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
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
@endsection