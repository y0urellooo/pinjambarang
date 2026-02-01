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
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f9;
        }

        .sidebar {
            width: 250px;
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

        /* tabel */
        .table-peminjaman th,
        .table-peminjaman td {
            padding: 12px 14px;
            /* jarak antar kolom */
            font-size: 0.9rem;
            /* kecilin font dikit */
            vertical-align: middle;
        }

        .table-peminjaman tbody tr {
            height: 60px;
            /* jarak antar baris */
        }

        .table-peminjaman th {
            white-space: nowrap;
            /* header tidak turun baris */
        }

        .table-peminjaman td {
            white-space: nowrap;
        }

        .table-peminjaman .badge {
            font-size: 0.75rem;
            padding: 6px 12px;
        }

        .table-peminjaman .btn {
            padding: 4px 10px;
            font-size: 0.75rem;
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
</body>

</html>