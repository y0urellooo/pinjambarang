<nav class="navbar navbar-expand-lg bg-white shadow-sm px-3">
    <div class="container-fluid">

        <span class="navbar-brand fw-semibold">
            @yield('page_title', 'Dashboard')
        </span>

        <div class="dropdown ms-auto">

            @auth
            @php
                $user = auth()->user();
                $fotoPath = $user->foto
                    ? ($user->role == 'petugas'
                        ? asset('foto_petugas/' . $user->foto)
                        : asset('foto_peminjam/' . $user->foto))
                    : null;
            @endphp

            <a class="btn btn-outline-primary dropdown-toggle d-flex align-items-center gap-2" href="#" role="button"
                data-bs-toggle="dropdown">

                @if ($fotoPath)
                    <img src="{{ $fotoPath }}" alt="Foto Profil" width="32" height="32" class="rounded-circle border">
                @else
                    <i class="bi bi-person-circle fs-4"></i>
                @endif

                <span>{{ $user->name }}</span>

            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li class="px-3 py-2 text-muted small">
                    Login sebagai<br>
                    <strong>{{ ucfirst($user->role) }}</strong>
                </li>

                <li><hr class="dropdown-divider"></li>

                {{-- Link Profil --}}
                @if ($user->role == 'peminjam')
                <li>
                    <a href="{{ route('peminjam.profile') }}" class="dropdown-item">
                        <i class="bi bi-person me-2"></i> Profil
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                @elseif ($user->role == 'petugas')
                <li>
                    <a href="{{ route('petugas.profile.show') }}" class="dropdown-item">
                        <i class="bi bi-person me-2"></i> Profil
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                @endif

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
            @endauth

            @guest
            <a href="{{ route('login') }}" class="btn btn-outline-primary">
                <i class="bi bi-box-arrow-in-right me-2"></i> Login
            </a>
            @endguest

        </div>

    </div>
</nav>
