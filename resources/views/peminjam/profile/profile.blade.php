@extends('layouts.app')

@section('page_title', 'Profil Peminjam')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-sm border-0">

                    {{-- HEADER --}}
                    <div class="card-body text-center bg-light rounded-top">
                        @if (auth()->user()->foto)
                            <img src="{{ asset('foto_peminjam/' . auth()->user()->foto) }}" class="rounded-circle mb-3 border"
                                width="120" height="120">
                        @else
                            <img src="{{ asset('default-avatar.png') }}" class="rounded-circle mb-3 border" width="120"
                                height="120">
                        @endif

                        <h5 class="fw-semibold mb-0">{{ auth()->user()->name }}</h5>
                        <small class="text-muted">{{ auth()->user()->email }}</small>
                    </div>

                    {{-- BODY --}}
                    <div class="card-body px-4">

                        <div class="row mb-3">
                            <div class="col-5 text-muted">No Telpon</div>
                            <div class="col-7 fw-semibold">
                                {{ auth()->user()->no_telpon }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-5 text-muted">Jenis Kelamin</div>
                            <div class="col-7 fw-semibold">
                                {{ auth()->user()->jenis_kelamin }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 text-muted">Alamat</div>
                            <div class="col-7 fw-semibold">
                                {{ auth()->user()->alamat }}
                            </div>
                        </div>

                    </div>

                    {{-- FOOTER (OPSIONAL, SIAP UNTUK NEXT STEP) --}}
                    <div class="card-footer bg-white text-end">
                        <a href="{{ route('peminjam.profile.edit') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil me-1"></i> Edit Profil
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection