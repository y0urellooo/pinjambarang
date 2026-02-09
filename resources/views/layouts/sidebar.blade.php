<aside class="sidebar-modern p-3 text-white d-flex flex-column">

    {{-- Sidebar Title --}}
    <h6 class="sidebar-title text-center fw-bold mb-1">Peminjaman Barang</h6>
    <hr>

    <div class="nav flex-column gap-1">

        @auth

            {{-- Admin --}}
            @if(auth()->user()->role === 'admin')
                <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>

                <a href="/admin/kategori" class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}">
                    <i class="bi bi-tags me-2"></i> Kategori
                </a>

                <a href="/admin/petugas" class="nav-link {{ request()->is('admin/petugas*') ? 'active' : '' }}">
                    <i class="bi bi-person-gear me-2"></i> Data Petugas
                </a>

                <a href="/admin/peminjam" class="nav-link {{ request()->is('admin/peminjam*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill me-2"></i> Data Peminjam
                </a>

                <a href="/admin/alat" class="nav-link {{ request()->is('admin/alat*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam me-2"></i> Alat
                </a>

                <a href="/admin/peminjaman" class="nav-link {{ request()->is('admin/peminjaman*') ? 'active' : '' }}">
                    <i class="bi bi-handbag me-2"></i> Peminjaman
                </a>

                <a href="/admin/pengembalian" class="nav-link {{ request()->is('admin/pengembalian*') ? 'active' : '' }}">
                    <i class="bi bi-check2-circle me-2"></i> Pengembalian
                </a>

                <a href="/admin/log-aktivitas" class="nav-link {{ request()->is('admin/log-aktivitas*') ? 'active' : '' }}">
                    <i class="bi bi-clock-history me-2"></i> Log Aktivitas
                </a>
            @endif

            {{-- Petugas --}}
            @if(auth()->user()->role === 'petugas')
                <a href="{{ route('petugas.dashboard') }}" class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a href="{{ route('petugas.peminjaman.index') }}" class="nav-link {{ request()->routeIs('petugas.peminjaman.*') ? 'active' : '' }}">
                    <i class="bi bi-handbag me-2"></i> Peminjaman
                </a>
                <a href="{{ route('petugas.pengembalian.index') }}" class="nav-link {{ request()->routeIs('petugas.pengembalian.*') ? 'active' : '' }}">
                    <i class="bi bi-check2-circle me-2"></i> Pengembalian
                </a>
                <a href="{{ route('petugas.laporan.index') }}" class="nav-link {{ request()->routeIs('petugas.laporan.*') ? 'active' : '' }}">
                    <i class="bi bi-envelope-paper me-2"></i> Laporan
                </a>
            @endif

            {{-- Peminjam --}}
            @if(auth()->user()->role === 'peminjam')
                <a href="{{ route('peminjam.dashboard') }}" class="nav-link {{ request()->routeIs('peminjam.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a href="{{ route('peminjam.alat.index') }}" class="nav-link {{ request()->routeIs('peminjam.alat.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam me-2"></i> Daftar Alat
                </a>
                <a href="{{ route('peminjam.peminjaman.index') }}" class="nav-link {{ request()->routeIs('peminjam.peminjaman.*') ? 'active' : '' }}">
                    <i class="bi bi-handbag me-2"></i> Peminjaman
                </a>
                <a href="{{ route('peminjam.pengembalian.index') }}" class="nav-link {{ request()->routeIs('peminjam.pengembalian.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-stack me-2"></i> Pengembalian
                </a>
            @endif

        @endauth

    </div>
</aside>

{{-- CSS Sidebar Gelap --}}
<style>
.sidebar-modern {
    background: linear-gradient(180deg, #0a2a5e, #061b3b); /* lebih gelap dari versi biru sebelumnya */
    min-height: 100vh;
    width: 240px;
    display: flex;
    flex-direction: column;
    padding: 1rem;
    box-shadow: 2px 0 10px rgba(0,0,0,0.3);
}

.sidebar-title {
    font-size: 0.95rem;
    letter-spacing: 0.5px;
    color: #fff;
}

.sidebar-divider {
    border-color: rgba(255,255,255,0.2);
}

.sidebar-modern .nav-link {
    color: rgba(255,255,255,0.85);
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.2s ease-in-out;
}

.sidebar-modern .nav-link i {
    font-size: 1.1rem;
}

.sidebar-modern .nav-link:hover {
    background-color: rgba(255,255,255,0.15);
    color: #fff;
}

.sidebar-modern .nav-link.active {
    background-color: rgba(255,255,255,0.25);
    color: #fff;
}

.sidebar-modern .nav-link.active i {
    color: #fff;
}
</style>
