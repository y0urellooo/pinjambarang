@extends('layouts.app')

@section('title', 'Dashboard Petugas')
@section('page_title', 'Dashboard Petugas')

@section('content')
<h3>Dashboard Petugas</h3>
<p>Halo, <strong>{{ auth()->user()->name }}</strong></p>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5>Pantau Pengajuan</h5>
                <a href="peminjaman" class="btn btn-success btn-sm">Lihat</a>
            </div>
        </div>
    </div>
</div>
@endsection
