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
            <div class="col-md-8 col-lg-7">

                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Register</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="/register" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <!-- KOLOM KIRI -->
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Masukkan email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">No Telpon</label>
                                        <input type="text" name="no_telpon" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="3" required></textarea>
                                    </div>

                                </div>

                                <!-- KOLOM KANAN -->
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Foto Peminjam</label>
                                        <input type="file" name="foto" class="form-control" accept="image/*">
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

                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">
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