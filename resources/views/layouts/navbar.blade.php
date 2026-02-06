<nav class="navbar navbar-expand-lg bg-white shadow-sm px-3">
    <div class="container-fluid">

        <span class="navbar-brand fw-semibold">
            @yield('page_title', 'Dashboard')
        </span>

        <div class="dropdown ms-auto">

            @auth
                <a class="btn btn-outline-primary dropdown-toggle d-flex align-items-center gap-2" href="#" role="button"
                    data-bs-toggle="dropdown">

                    @if (auth()->user()->foto)
                        <img src="{{ asset('foto_peminjam/' . auth()->user()->foto) }}" alt="Foto Profil" width="32" height="32"
                            class="rounded-circle border">
                    @else
                        <i class="bi bi-person-circle fs-4"></i>
                    @endif

                    <span>{{ auth()->user()->name }}</span>

                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li class="px-3 py-2 text-muted small">
                        Login sebagai<br>
                        <strong>{{ auth()->user()->role }}</strong>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    @if (auth()->user()->role == 'peminjam')
                        <li>
                            <a href="{{ route('peminjam.profile') }}" class="dropdown-item">
                                <i class="bi bi-person me-2"></i> Profil
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
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