<aside class="sidebar p-3 text-white">
    <h5 class="text-center mb-4">SIPAT APP</h5>

    @php
        $role = auth()->user()->role;
    @endphp

    <div class="nav flex-column gap-1">

        @if ($role === 'admin')
        <a href="/admin/dashboard"
           class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="/admin/kategori"
           class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}">
            <i class="bi bi-tags me-2"></i> Kategori
        </a>

        <a href="/admin/users"
           class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
            <i class="bi bi-people-fill me-2"></i> User
        </a>

        <a href="/admin/alat"
           class="nav-link {{ request()->is('admin/alat*') ? 'active' : '' }}">
            <i class="bi bi-box-seam me-2"></i> Alat
        </a>

        <a href="/admin/peminjaman"
           class="nav-link {{ request()->is('admin/peminjaman*') ? 'active' : '' }}">
            <i class="bi bi-cart me-2"></i> Peminjaman
        </a>
        @endif

    </div>
</aside>
