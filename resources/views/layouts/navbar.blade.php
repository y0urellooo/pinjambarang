<nav class="navbar navbar-expand-lg py-3 navbar-blur">
    <div class="container d-flex justify-content-between align-items-center">

        {{-- Logo & Page Title --}}
        <div class="d-flex align-items-center ms-2">
            <div class="icon-bg">
                <i class="bi bi-grid-fill text-white"></i>
            </div>
            <div>
                <h5 class="mb-0 page-title">
                    @yield('page_title', 'Dashboard')
                </h5>
            </div>
        </div>

        {{-- User & Notification --}}
        <div class="d-flex align-items-center">

            @auth
                @php
                    $user = auth()->user();
                    $fotoPath = $user->foto ? asset(
                        ($user->role == 'admin' ? 'foto_admin' : ($user->role == 'petugas' ? 'foto_petugas' : 'foto_peminjam'))
                        . '/' . $user->foto
                    ) : null;
                @endphp

                {{-- Notification --}}
                <button class="btn btn-light btn-sm rounded-circle me-3 shadow-sm">
                    <i class="bi bi-bell text-muted"></i>
                </button>

                {{-- User Dropdown --}}
                <div class="dropdown dropdown-user">
                    <div class="user-pill d-flex align-items-center p-1 pe-3" role="button" data-bs-toggle="dropdown">
                        {{-- Foto --}}
                        <div class="me-2">
                            @if($fotoPath)
                                <img src="{{ $fotoPath }}" alt="Profile" class="profile-img">
                            @else
                                <div class="profile-placeholder">
                                    <i class="bi bi-person text-primary"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Nama & Role --}}
                        <div class="d-none d-sm-block me-2">
                            <p class="mb-0 fw-bold user-name">{{ Str::words($user->name,1,'') }}</p>
                            <span class="badge user-role">{{ strtoupper($user->role) }}</span>
                        </div>

                        <i class="bi bi-chevron-down small text-muted"></i>
                    </div>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-user-menu shadow-lg p-2">
                        <li><h6 class="dropdown-header fw-bold pb-2">Menu Akun</h6></li>

                        @if($user->role == 'admin')
                            <li><a href="{{ route('admin.profile.show') }}" class="dropdown-item"><i class="bi bi-person-badge me-2 text-primary"></i> Pengaturan Profil</a></li>
                        @elseif($user->role == 'petugas')
                            <li><a href="{{ route('petugas.profile.show') }}" class="dropdown-item"><i class="bi bi-person-badge me-2 text-primary"></i> Pengaturan Profil</a></li>
                        @elseif($user->role == 'peminjam')
                            <li><a href="{{ route('peminjam.profile') }}" class="dropdown-item"><i class="bi bi-person-badge me-2 text-primary"></i> Profil Saya</a></li>
                        @endif

                        <li><hr class="dropdown-divider opacity-50"></li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-semibold">
                                    <i class="bi bi-power me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            {{-- Guest --}}
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold">
                    Login <i class="bi bi-arrow-right-short ms-1"></i>
                </a>
            @endguest

        </div>
    </div>
</nav>

{{-- CSS --}}
<style>
.navbar-blur {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid #eee;
    z-index: 1000;
}

.icon-bg {
    background-color: #0d6efd;
    width: 40px;
    height: 40px;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
}

.page-title {
    letter-spacing: -0.5px;
}

.page-subtitle {
    font-size: 0.7rem;
    margin-top: -2px;
}

.dropdown-user {
    position: relative;
}

.user-pill {
    border-radius: 50px;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.profile-img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.profile-placeholder {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.user-name {
    font-size: 0.85rem;
    line-height: 1;
    margin-bottom: 0;
}

.user-role {
    font-size: 0.65rem;
    background-color: rgba(13,110,253,0.1);
    color: #0d6efd;
    border-radius: 50px;
    padding: 0.15rem 0.5rem;
}

.dropdown-user-menu {
    border-radius: 15px;
    min-width: 220px;
    right: 0;
    left: auto;
}
</style>
