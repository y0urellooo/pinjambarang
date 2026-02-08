@extends('layouts.app')

@section('title', 'Data Pengembalian')
@section('page_title', 'Data Pengembalian')

@section('content')
<h3 class="mb-4">Riwayat Pengembalian</h3>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Foto Alat</th>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali Rencana</th>
                    <th>Tgl Kembali Aktual</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengembalians as $item)
                <tr class="text-center align-middle">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->peminjaman->user->name }}</td>

                    {{-- FOTO ALAT --}}
                    <td>
                        @if($item->peminjaman->alat->foto)
                            <img src="{{ asset('foto_alat/' . $item->peminjaman->alat->foto) }}" 
                                 width="50" height="50" class="img-thumbnail" alt="{{ $item->peminjaman->alat->nama_alat }}">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>{{ $item->peminjaman->alat->nama_alat }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali_rencana)->format('d M Y') }}</td>
                    <td>{{ $item->tanggal_kembali_aktual ? Carbon\Carbon::parse($item->tanggal_kembali_aktual)->format('d M Y') : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada data pengembalian
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
