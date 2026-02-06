@extends('layouts.app')

@section('title', 'Dashboard Petugas')
@section('page_title', 'Dashboard')

@section('content')
{{-- Header --}}
<div class="mb-4">
    <h3 class="fw-semibold mb-1">Dashboard Petugas</h3>
    <p class="text-muted mb-0">
        Selamat datang kembali,
        <span class="fw-semibold text-dark">
            {{ auth()->user()->name }}
        </span>
    </p>
</div>

{{-- Statistik / Aksi Cepat --}}
<div class="row g-4 mt-2">

    <div class="col-md-4">
        <div class="card border-0 shadow-lg rounded-4 h-100">
            <div class="card-body d-flex flex-column justify-content-between text-center">

                <div>
                    <div class="mb-3">
                        <i class="bi bi-handbag fs-1 text-success"></i>
                    </div>

                    <h5 class="fw-semibold mb-1">
                        Pantau Pengajuan
                    </h5>

                    <p class="text-muted small mb-3">
                        Lihat & kelola pengajuan peminjaman barang
                    </p>
                </div>

                <a href="peminjaman"
                   class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-eye me-1"></i> Lihat Data
                </a>

            </div>
        </div>
    </div>

    {{-- card tambahan (opsional biar dashboard berisi) --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-lg rounded-4 h-100">
            <div class="card-body d-flex flex-column justify-content-between text-center">

                <div>
                    <div class="mb-3">
                        <i class="bi bi-check2-circle fs-1 text-primary"></i>
                    </div>

                    <h5 class="fw-semibold mb-1">
                        Pengembalian
                    </h5>

                    <p class="text-muted small mb-3">
                        Kelola barang yang sudah dikembalikan
                    </p>
                </div>

                <a href="pengembalian"
                   class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-arrow-repeat me-1"></i> Kelola
                </a>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-lg rounded-4 h-100">
            <div class="card-body d-flex flex-column justify-content-between text-center">

                <div>
                    <div class="mb-3">
                        <i class="bi bi-person-badge fs-1 text-warning"></i>
                    </div>

                    <h5 class="fw-semibold mb-1">
                        Akun Anda
                    </h5>

                    <p class="text-muted small mb-3">
                        Role: <span class="fw-semibold text-dark">
                            {{ auth()->user()->role }}
                        </span>
                    </p>
                </div>

                <span class="badge bg-warning text-dark rounded-pill py-2">
                    Petugas Aktif
                </span>

            </div>
        </div>
    </div>

</div>
@endsection
