@extends('layouts.app')

@section('title', 'Dashboard Peminjam')
@section('page_title', 'Dashboard Peminjam')

@section('content')
<h3>Dashboard Peminjam</h3>
<p>Selamat datang, <strong>{{ auth()->user()->name }}</strong></p>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="fw-semibold">Daftar Alat</h5>
                <a href="alat" class="btn btn-warning btn-sm">Lihat</a>
            </div>
        </div>
    </div>
</div>
@endsection
