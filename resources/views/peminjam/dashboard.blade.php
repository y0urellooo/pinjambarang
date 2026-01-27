@extends('layout.app')

@section('title', 'Dashboard Peminjam')

@section('content')
<h3>Dashboard Peminjam</h3>
<p>Selamat datang, <strong>{{ auth()->user()->name }}</strong></p>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5>Ajukan Peminjaman</h5>
                <a href="#" class="btn btn-warning btn-sm">Ajukan</a>
            </div>
        </div>
    </div>
</div>
@endsection
