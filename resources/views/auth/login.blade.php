<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">

                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Login</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="/login">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email anda"
                                    required>
                            </div>

                            <!-- <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukkan password anda" required>
                            </div> -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>

                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Masukkan password anda" required>

                                    <span class="input-group-text" style="cursor: pointer" onclick="togglePassword()">
                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Login
                            </button>

                            <div class="text-center mt-3">
                                <small>
                                    Belum punya akun?
                                    <a href="/register">register</a>
                                </small>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            if (password.type === "password") {
                password.type = "text";
                eyeIcon.classList.replace("bi-eye", "bi-eye-slash");
            } else {
                password.type = "password";
                eyeIcon.classList.replace("bi-eye-slash", "bi-eye");
            }
        }
    </script>

</body>

</html>