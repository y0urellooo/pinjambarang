@extends('layouts.app')

@section('title', 'Pemantauan Pengembalian')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-semibold">
                📦 Pemantauan Pengembalian Barang
            </h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Peminjam</th>
                            <th class="text-center">Barang</th>
                            <th class="text-center">Tanggal Pinjam</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($peminjaman as $item)
                        <tr>
                            <td class="fw-medium">
                                {{ $item->nama_peminjam }}
                            </td>

                            <td class="text-center">
                                {{ $item->nama_barang ?? '-' }}
                            </td>

                            <td class="text-center">
                                {{ optional($item->tanggal_pinjam)->format('d M Y') ?? $item->tanggal_pinjam ?? '-' }}
                            </td>

                            <td class="text-center">
                                <span class="badge rounded-pill bg-primary px-3 py-2">
                                    Dipinjam
                                </span>
                            </td>

                            <td class="text-center">
                                <form action="{{ url('petugas/pengembalian/'.$item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-check2-circle"></i> Tandai Dikembalikan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Tidak ada barang yang sedang dipinjam
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
