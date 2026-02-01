<aside class="sidebar p-3 text-white">
    <h5 class="fw-semibold text-center">Peminjaman Barang</h5>
    <hr>

    <div class="nav flex-column gap-1">

        @auth

        {{-- sidebar admin --}}
        @if(auth()->user()->role === 'admin')

        <a href="/admin/dashboard"
            class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="/admin/kategori"
            class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}">
            <i class="bi bi-tags me-2"></i> Kategori
        </a>

        <!-- <a href="/admin/users"
            class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
            <i class="bi bi-people-fill me-2"></i> User
        </a> -->

        <a href="/admin/petugas"
            class="nav-link {{ request()->is('admin/petugas*') ? 'active' : '' }}">
            <i class="bi bi-person-gear me-2"></i> Data Petugas
        </a>

        <a href="/admin/peminjam"
            class="nav-link {{ request()->is('admin/peminjam*') ? 'active' : '' }}">
            <i class="bi bi-people-fill me-2"></i> Data Peminjam
        </a>

        <a href="/admin/alat"
            class="nav-link {{ request()->is('admin/alat*') ? 'active' : '' }}">
            <i class="bi bi-box-seam me-2"></i> Alat
        </a>

        <a href="/admin/peminjaman"
            class="nav-link {{ request()->is('admin/peminjaman*') ? 'active' : '' }}">
            <i class="bi bi-handbag me-2"></i> Peminjaman
        </a>

        <a href="/admin/pengembalian"
            class="nav-link {{ request()->is('admin/pengembalian*') ? 'active' : '' }}">
            <i class="bi bi-check2-circle me-2"></i> Pengembalian
        </a>

        <a href="/admin/log-aktivitas"
            class="nav-link {{ request()->is('admin/log-aktvitas*') ? 'active' : '' }}">
            <i class="bi bi-clock-history me-2"></i> Log Aktivitas
        </a>
        @endif

        {{-- sidebar petugas --}}
        @if(auth()->user()->role === 'petugas')

        <a href="dashboard"
            class="nav-link {{ request()->is('petugas/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="peminjaman"
            class="nav-link {{ request()->is('petugas/peminjaman*') ? 'active' : '' }}">
            <i class="bi bi-handbag me-2"></i> Peminjaman
        </a>

        <a href="pengembalian"
            class="nav-link {{ request()->is('petugas/pengembalian*') ? 'active' : '' }}">
            <i class="bi bi-check2-circle me-2"></i> Pengembalian
        </a>

        <a href="laporan"
            class="nav-link {{ request()->is('petugas/laporan*') ? 'active' : '' }}">
            <i class="bi bi-envelope-paper me-2"></i> Laporan
        </a>

        @endif


        {{-- sidebar peminjam --}}
        @if(auth()->user()->role === 'peminjam')

        <a href="dashboard"
            class="nav-link {{ request()->is('peminjam/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="alat"
            class="nav-link {{ request()->is('peminjam/alat*') ? 'active' : '' }}">
            <i class="bi bi-box-seam me-2"></i> Daftar Alat
        </a>

        <a href="peminjaman"
            class="nav-link {{ request()->is('peminjam/peminjaman*') ? 'active' : '' }}">
            <i class="bi bi-handbag me-2"></i> Peminjaman
        </a>

        <a href="pengembalian"
            class="nav-link {{ request()->is('peminjam/pengembalian*') ? 'active' : '' }}">
            <i class="bi bi-check2-circle me-2"></i> Pengembalian
        </a>

        @endif

        @endauth

    </div>
</aside>