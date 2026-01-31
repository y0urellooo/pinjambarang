@extends('layouts.app')

@section('title', 'Cetak Laporan Peminjaman')

@section('content')
<div class="container py-4">

    <h4 class="mb-4 text-center">📋 Laporan Peminjaman</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mencetak as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_peminjam }}</td>
                        <td>
                            <span class="badge rounded-pill 
                                @if($item->status == 'dipinjam') bg-primary 
                                @elseif($item->status == 'dikembalikan') bg-success 
                                @else bg-warning text-dark @endif px-3 py-2">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script>
    // otomatis print saat halaman dibuka
    window.onload = function() {
        window.print();
    }
</script>
@endsection
