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

    <!-- GLOBAL CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fdf2f8, #fce7f3);
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #ec4899, #db2777);
            color: #fff;
            box-shadow: 8px 0 25px rgba(0, 0, 0, 0.15);
        }

        .sidebar h5 {
            font-weight: 700;
            letter-spacing: 1px;
        }

        .sidebar hr {
            border-color: rgba(255, 255, 255, 0.3);
        }

        .sidebar .nav-link {
            color: #fde7f3;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 0.9rem;
            transition: all 0.25s ease;
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #fff;
            color: #db2777;
            font-weight: 600;
        }

        .sidebar .nav-link.active i {
            color: #db2777;
        }

        /* ================= CONTENT ================= */
        main {
            background: #fdf2f8;
            min-height: 100vh;
            border-radius: 30px 0 0 30px;
        }

        /* ================= CARD ================= */
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(219, 39, 119, 0.15);
        }

        .card h5 {
            font-weight: 600;
        }

        /* ================= TABLE ================= */
        .table {
            font-size: 0.9rem;
        }

        .table thead {
            background: linear-gradient(90deg, #ec4899, #db2777);
            color: #fff;
        }

        .table thead th {
            border: none;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #fce7f3;
        }

        /* ================= BADGE ================= */
        .badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
        }

        /* ================= BUTTON ================= */
        .btn {
            border-radius: 12px;
            font-size: 0.75rem;
            padding: 6px 14px;
        }

        .btn-success {
            background: linear-gradient(90deg, #22c55e, #16a34a);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(90deg, #ef4444, #dc2626);
            border: none;
        }

        .btn-primary {
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            border: none;
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
