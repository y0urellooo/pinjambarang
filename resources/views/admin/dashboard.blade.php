@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h3>Dashboard Admin</h3>
<p>Selamat datang, <strong>{{ auth()->user()->name }}</strong></p>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5>Data User</h5>
                <a href="#" class="btn btn-primary btn-sm">Kelola</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5>Data Barang</h5>
                <a href="#" class="btn btn-primary btn-sm">Kelola</a>
            </div>
        </div>
    </div>
</div>
@endsection
