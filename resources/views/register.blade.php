<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">

                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Register</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="/register">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Masukkan nama" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Masukkan email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukkan password" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Ulangi password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Register
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <small>
                                Sudah punya akun?
                                <a href="/login">Login</a>
                            </small>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
