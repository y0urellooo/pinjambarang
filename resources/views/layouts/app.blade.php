
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }

        body {
            background: #f1f5f9;
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: #020617;
            color: white;
            padding: 30px 20px;
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #e5e7eb;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .sidebar a:hover {
            background: #1e293b;
        }

        /* CONTENT */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        header {
            background: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
        }

        header form button {
            background: #dc2626;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        main {
            padding: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>{{ ucfirst(auth()->user()->role) }}</h2>

    <a href="/{{ auth()->user()->role }}/dashboard">Dashboard</a>

    {{-- ADMIN --}}
    @if(auth()->user()->role === 'admin')
        <a href="/admin/users">User</a>
        <a href="/admin/kategori">Kategori</a>
        <a href="/admin/alat">Alat</a>
        <a href="/admin/peminjaman">Peminjaman</a>
        <a href="/admin/pengembalian">Pengembalian</a>
        <a href="/admin/log-aktivitas">Log Aktivitas</a>
    @endif

    {{-- PETUGAS --}}
    @if(auth()->user()->role === 'petugas')
        <a href="/petugas/menyetujui-peminjaman">Menujui Peminjaman</a>
        <a href="/petugas/memantau-pengembalian">Memantau Pengembalian</a>
        <a href="/petugas/mencetak-laporan">Mencetak Laporan</a>
    @endif

    {{-- PEMINJAM --}}
    @if(auth()->user()->role === 'peminjam')
        <a href="/peminjam/peminjaman">Ajukan Peminjaman</a>
        <a href="/peminjam/riwayat">Riwayat Peminjaman</a>
    @endif
</div>

<!-- CONTENT -->
<div class="content">
    <header>
        <h3>@yield('title')</h3>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>

    <main>
        @yield('content')
    </main>
</div>

</body>
</html>
