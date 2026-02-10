@extends('layouts.app')

@section('title', 'Dashboard Petugas')
@section('page_title', 'Dashboard Petugas')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Dashboard Petugas</h3>
            <p class="text-muted">
                Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Berikut ringkasan tugas hari ini.
            </p>
        </div>
        <div>
            <span class="badge bg-primary px-3 py-2">
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card stat-card bg-primary text-white h-100">
                <div class="card-body p-4">
                    <h6 class="text-uppercase opacity-75 fw-bold">Total Peminjaman</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ $totalPeminjaman }}</h2>
                    <small>Semua data</small>
                    <i class="bi bi-clipboard-data stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card bg-warning text-white h-100">
                <div class="card-body p-4">
                    <h6 class="text-uppercase opacity-75 fw-bold">Sedang Dipinjam</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ $dipinjam }}</h2>
                    <small>Belum dikembalikan</small>
                    <i class="bi bi-box-arrow-up stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card bg-success text-white h-100">
                <div class="card-body p-4">
                    <h6 class="text-uppercase opacity-75 fw-bold">Dikembalikan</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ $dikembalikan }}</h2>
                    <small>Selesai</small>
                    <i class="bi bi-check-circle stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card bg-danger text-white h-100">
                <div class="card-body p-4">
                    <h6 class="text-uppercase opacity-75 fw-bold">Terlambat</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ $terlambat }}</h2>
                    <small>Perlu perhatian</small>
                    <i class="bi bi-exclamation-triangle stat-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- TABEL PEMINJAMAN TERBARU --}}
        <div class="col-lg-8">
            <div class="table-container shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Peminjaman Terbaru</h5>
                    <a href="{{ route('petugas.peminjaman.index') }}"
                       class="btn btn-sm btn-outline-primary rounded">
                        Lihat Semua
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-primary text-muted small text-center">
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($peminjamanTerbaru as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $item->user->name ?? '-' }}</td>
                                    <td>{{ $item->tanggal_pinjam }}</td>
                                    <td class="text-center">
                                        @switch($item->status)
                                            @case('dipinjam')
                                                <span class="badge badge-soft-primary">Dipinjam</span>
                                                @break

                                            @case('dikembalikan')
                                                <span class="badge badge-soft-success">Dikembalikan</span>
                                                @break

                                            @case('ditolak')
                                                <span class="badge badge-soft-danger">Ditolak</span>
                                                @break

                                            @case('terlambat')
                                                <span class="badge badge-soft-warning">Terlambat</span>
                                                @break

                                            @default
                                                <span class="badge badge-soft-secondary">Menunggu</span>
                                        @endswitch
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        Belum ada data peminjaman
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- AKSI CEPAT --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Aksi Cepat</h5>

                    <div class="row g-2">
                        <div class="col-6">
                            <a href="{{ route('petugas.peminjaman.index') }}"
                               class="btn w-100 quick-action p-3 text-start">
                                <i class="bi bi-journal-check text-primary fs-4 d-block mb-2"></i>
                                <span class="small fw-bold">Peminjaman</span>
                            </a>
                        </div>

                        <div class="col-6">
                            <a href="{{ route('petugas.pengembalian.index') }}"
                               class="btn w-100 quick-action p-3 text-start">
                                <i class="bi bi-arrow-return-left text-success fs-4 d-block mb-2"></i>
                                <span class="small fw-bold">Pengembalian</span>
                            </a>
                        </div>

                        <div class="col-6">
                            <a href="{{ route('petugas.laporan.index') }}"
                               class="btn w-100 quick-action p-3 text-start">
                                <i class="bi bi-file-earmark-text text-dark fs-4 d-block mb-2"></i>
                                <span class="small fw-bold">Laporan</span>
                            </a>
                        </div>

                        <div class="col-6">
                            <a href="{{ route('petugas.profile.show') }}"
                               class="btn w-100 quick-action p-3 text-start">
                                <i class="bi bi-person-circle text-warning fs-4 d-block mb-2"></i>
                                <span class="small fw-bold">Profil</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stat-card {
    border-radius: 15px;
    border: none;
    position: relative;
    transition: 0.3s;
}
.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.12);
}
.stat-icon {
    position: absolute;
    right: -10px;
    bottom: -10px;
    font-size: 5rem;
    opacity: 0.15;
}
.table-container {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
}
.quick-action {
    border-radius: 12px;
    border: 1px solid #eee;
    transition: 0.3s;
}
.quick-action:hover {
    background: #f8f9fa;
    border-color: #0d6efd;
}
.badge-soft-primary  { background: #e7f1ff; color: #0d6efd; }
.badge-soft-success  { background: #e6f7ee; color: #198754; }
.badge-soft-warning  { background: #fff4e5; color: #fd7e14; }
.badge-soft-danger   { background: #fdecea; color: #dc3545; }
.badge-soft-secondary{ background: #f1f3f5; color: #6c757d; }
</style>
@endsection
