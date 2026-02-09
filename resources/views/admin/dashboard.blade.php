@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Dashboard Admin</h3>
            <p class="text-muted">Selamat datang kembali, <strong>Admin!</strong> Berikut ringkasan hari ini.</p>
        </div>
        <div class="text-end">
            <span class="badge bg-primary px-3 py-2">{{ now()->format('d M Y') }}</span>
        </div>
    </div>

    {{-- STATISTIK UTAMA --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-primary text-white h-100">
                <div class="card-body p-4">
                    <h6 class="text-uppercase opacity-75 fw-bold">Total Alat</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ $totalAlat }}</h2>
                    <small>Alat terdaftar</small>
                    <i class="bi bi-box stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-success text-white h-100">
                <div class="card-body p-4">
                    <h6 class="text-uppercase opacity-75 fw-bold">Kategori</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ $totalKategori }}</h2>
                    <small>Pengelompokan alat</small>
                    <i class="bi bi-tags stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-info text-white h-100">
                <div class="card-body p-4">
                    <h6 class="text-uppercase opacity-75 fw-bold">Tersedia</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ $alatTersedia }}</h2>
                    <small>Siap dipinjamkan</small>
                    <i class="bi bi-check-circle stat-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-danger text-white h-100">
                <div class="card-body p-4">
                    <h6 class="text-uppercase opacity-75 fw-bold">Stok Habis</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ $alatHabis }}</h2>
                    <small>Perlu pengadaan</small>
                    <i class="bi bi-exclamation-triangle stat-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- TABEL ALAT TERBARU (KIRI) --}}
        <div class="col-lg-8">
            <div class="table-container border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Alat Terbaru Ditambahkan</h5>
                    <a href="{{ route('admin.alat.index') }}" class="btn btn-sm btn-outline-primary rounded">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="text-muted small uppercase">
                            <tr>
                                <th>Data Alat</th>
                                <th  class="text-center">Kategori</th>
                                <th  class="text-center">Status</th>
                                <th  class="text-center">Stok</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center">
                            @forelse($alatTerbaru as $alat)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($alat->foto)
                                            <img src="{{ asset('foto_alat/' . $alat->foto) }}" width="45" height="45" class="rounded-3 shadow-sm me-3 object-fit-cover">
                                        @else
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center me-3" style="width:45px; height:45px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $alat->nama_alat }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <span class="badge bg-light text-dark border">{{ $alat->kategori->nama_kategori }}</span>
                                </td>
                                <td >
                                    @if($alat->jumlah_alat > 0)
                                        <span class="badge badge-soft-success">Ready</span>
                                    @else
                                        <span class="badge badge-soft-danger">Empty</span>
                                    @endif
                                </td>
                                <td class="text-center fw-bold">{{ $alat->jumlah_alat }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada data tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- QUICK ACCESS & INFO (KANAN) --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Aksi Cepat</h5>
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="{{ route('admin.peminjam.index') }}" class="btn w-100 quick-action p-3 text-start">
                                <i class="bi bi-people-fill text-warning d-block mb-2 fs-4"></i>
                                <span class="small fw-bold">User Baru</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.peminjaman.index') }}" class="btn w-100 quick-action p-3 text-start">
                                <i class="bi bi-cart-plus text-danger d-block mb-2 fs-4"></i>
                                <span class="small fw-bold">Peminjaman</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.pengembalian.index') }}" class="btn w-100 quick-action p-3 text-start">
                                <i class="bi bi-cart-check-fill text-success d-block mb-2 fs-4"></i>
                                <span class="small fw-bold">Pengembalian</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.peminjaman.index') }}" class="btn w-100 quick-action p-3 text-start">
                                <i class="bi bi-clock-history text-primary d-block mb-2 fs-4"></i>
                                <span class="small fw-bold">Log Aktivitas</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MINI TIPS/INFO --}}
            <div class="alert alert-primary border-0 p-4" style="border-radius: 15px;">
                <h6 class="fw-bold"><i class="bi bi-lightbulb me-2"></i>Tips Admin</h6>
                <small class="d-block mb-2">Gunakan fitur <strong>Stok Habis</strong> untuk memantau alat yang perlu segera dibeli atau diservis.</small>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styling untuk membuat dashboard lebih 'hidup' */
    .stat-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .stat-icon {
        position: absolute;
        right: -10px;
        bottom: -10px;
        font-size: 5rem;
        opacity: 0.15;
        transform: rotate(-15deg);
    }
    .quick-action {
        border-radius: 12px;
        border: 1px solid #eee;
        transition: 0.3s;
        font-size: 15px;
    }
    .quick-action:hover {
        background-color: #f8f9fa;
        border-color: #0d6efd;
    }
    .table-container {
        border-radius: 15px;
        background: #fff;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .badge-soft-success { background: #e6f7ee; color: #198754; }
    .badge-soft-danger { background: #fdecea; color: #dc3545; }
</style>
@endsection