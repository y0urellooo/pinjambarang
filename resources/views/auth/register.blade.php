@extends('layouts.landing')

@section('title', 'Register')

@push('styles')
<style>
    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .auth-card {
        background: white;
        padding: 40px;
        width: 380px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,.1);
    }

    .auth-card h2 {
        text-align: center;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: 500;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .btn-auth {
        width: 100%;
        background: #020617;
        color: white;
        padding: 12px;
        border-radius: 8px;
        border: none;
        margin-top: 10px;
        font-weight: 600;
        cursor: pointer;
    }

    .auth-footer {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    .auth-footer a {
        color: #020617;
        font-weight: 600;
        text-decoration: none;
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h2>Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button class="btn-auth">Register</button>
        </form>

        <div class="auth-footer">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</div>
@endsection
