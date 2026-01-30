@extends('layouts.app')

@section('title', 'Persetujuan Peminjaman')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-semibold">
                📋 Persetujuan Peminjaman
            </h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Peminjam</th>
                            <th class="text-center">Barang</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($peminjaman as $item)
                        <tr>
                            <td class="fw-medium">
                                {{ $item->nama }}
                            </td>

                            <td class="text-center">
                                {{ $item->barang ?? '-' }}
                            </td>

                            <td class="text-center">
                                {{ optional($item->created_at)->format('d M Y') ?? '-' }}
                            </td>

                            <td class="text-center">
                                <span class="badge rounded-pill bg-warning text-dark px-3 py-2">
                                    Menunggu
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Setujui -->
                                    <form action="{{ url('petugas/peminjaman/'.$item->id.'/setujui') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="bi bi-check-circle"></i> Setujui
                                        </button>
                                    </form>

                                    <!-- Tolak -->
                                    <form action="{{ url('petugas/peminjaman/'.$item->id.'/tolak') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-x-circle"></i> Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Tidak ada peminjaman menunggu persetujuan
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
