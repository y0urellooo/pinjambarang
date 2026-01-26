<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">
            Sistem Peminjaman
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
