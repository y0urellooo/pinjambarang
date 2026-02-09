~@extends('layouts.app')

@section('title', 'Profil Petugas')
@section('page_title', 'Profil Petugas')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm border-0">

                {{-- HEADER --}}
                <div class="card-body text-center bg-light rounded-top">
                    @if (auth()->user()->foto)
                        <img src="{{ asset('foto_petugas/' . auth()->user()->foto) }}" class="rounded-circle mb-3 border"
                             width="120" height="120">
                    @else
                        <img src="{{ asset('default-avatar.png') }}" class="rounded-circle mb-3 border" width="120"
                             height="120">
                    @endif

                    <h5 class="fw-semibold mb-0">{{ auth()->user()->name }}</h5>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>

                {{-- FOOTER --}}
                <div class="card-footer text-end">
                    <a href="{{ route('petugas.profile.edit') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil me-1"></i> Edit Profil
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
 