<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SIPAT')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- GLOBAL CSS (tidak diubah dari halaman) -->
    <style>
        body {
            font-family: 'Poppins';
            background-color: #f1f5f9;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #020617;
        }

        .sidebar .nav-link {
            color: #e5e7eb;
            border-radius: 8px;
        }

        .sidebar .nav-link:hover {
            background: #1e293b;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #334155;
            color: #fff;
        }

        .deskripsi-wrapper {
            white-space: normal;
            word-break: break-word;
        }

        /* dashboard */
        .dashboard-card {
    border-radius: 8px;
    padding: 20px;
    color: #333;
    position: relative;
    overflow: hidden;
    transition: 0.2s;
}

.dashboard-card:hover {
    transform: translateY(-3px);
}

.dashboard-card .icon {
    font-size: 48px;
    opacity: 0.25;
    position: absolute;
    right: 15px;
    bottom: 15px;
}

.dashboard-card .count {
    font-size: 36px;
    font-weight: bold;
}

.dashboard-card .title {
    font-size: 14px;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.dashboard-card a {
    font-size: 13px;
    text-decoration: none;
}

    </style>

    @stack('css')
</head>

<body>

    <div class="d-flex">
        {{-- SIDEBAR --}}
        @include('layouts.sidebar')

        <div class="flex-grow-1">
            {{-- NAVBAR --}}
            @include('layouts.navbar')

            {{-- CONTENT --}}
            <main class="container-fluid p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('js')

    <script>
        function toggleDeskripsi(el) {
            const wrapper = el.closest('.deskripsi-wrapper');
            const shortText = wrapper.querySelector('.short-text');
            const fullText = wrapper.querySelector('.full-text');

            if (fullText.classList.contains('d-none')) {
                shortText.classList.add('d-none');
                fullText.classList.remove('d-none');
                el.textContent = 'Sembunyikan';
            } else {
                shortText.classList.remove('d-none');
                fullText.classList.add('d-none');
                el.textContent = 'Lihat selengkapnya';
            }
        }
    </script>

</body>

</html>