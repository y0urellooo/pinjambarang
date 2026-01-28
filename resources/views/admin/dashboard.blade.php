@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h3 class="fw-bold mb-4">Dashboard Admin</h3>

<div class="row g-4">

    {{-- TOTAL ALAT --}}
    <div class="col-md-3">
        <div class="card text-white border-0 shadow"
             style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-box-seam fs-1 me-3"></i>
                <div>
                    <small>Total Alat</small>
                    <h3 class="fw-bold mb-0">{{ $totalAlat }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- TOTAL KATEGORI --}}
    <div class="col-md-3">
        <div class="card text-white border-0 shadow"
             style="background: linear-gradient(135deg, #22c55e, #16a34a);">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-tags fs-1 me-3"></i>
                <div>
                    <small>Kategori</small>
                    <h3 class="fw-bold mb-0">{{ $totalKategori }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- ALAT TERSEDIA --}}
    <div class="col-md-3">
        <div class="card text-white border-0 shadow"
             style="background: linear-gradient(135deg, #06b6d4, #0891b2);">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-check-circle fs-1 me-3"></i>
                <div>
                    <small>Alat Tersedia</small>
                    <h3 class="fw-bold mb-0">{{ $alatTersedia }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- STOK HABIS --}}
    <div class="col-md-3">
        <div class="card text-white border-0 shadow"
             style="background: linear-gradient(135deg, #ef4444, #dc2626);">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-x-circle fs-1 me-3"></i>
                <div>
                    <small>Stok Habis</small>
                    <h3 class="fw-bold mb-0">{{ $alatHabis }}</h3>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- SECTION BAWAH --}}
<div class="row mt-4 g-4">

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-semibold mb-3">
                    <i class="bi bi-info-circle text-primary"></i>
                    Informasi Sistem
                </h5>
                <ul class="mb-0">
                    <li>Kelola data alat & kategori dengan mudah</li>
                    <li>Alat stok 0 otomatis tidak bisa dipinjam</li>
                    <li>Data peminjaman akan tercatat rapi</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-semibold mb-3">
                    <i class="bi bi-lightning-fill text-warning"></i>
                    Akses Cepat
                </h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('alat.index') }}" class="btn btn-primary">
                        <i class="bi bi-box"></i> Data Alat
                    </a>
                    <a href="{{ route('kategori.index') }}" class="btn btn-success">
                        <i class="bi bi-tags"></i> Data Kategori
                    </a>
                    <a href="{{ route('users.index') }}" class="btn btn-dark">
                        <i class="bi bi-people"></i> Manajemen User
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
