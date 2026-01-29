@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="card">
    <h2>Selamat Datang, Admin</h2>
    <p>
        Anda memiliki akses penuh terhadap sistem peminjaman alat.
    </p>

    <ul style="margin-top: 15px;">
        <li>Kelola data alat</li>
        <li>Kelola petugas</li>
        <li>Kelola peminjam</li>
        <li>Lihat laporan peminjaman</li>
    </ul>
</div>
@endsection
