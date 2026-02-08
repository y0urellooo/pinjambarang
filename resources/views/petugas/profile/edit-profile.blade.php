@extends('layouts.app')

@section('page_title', 'Edit Profil Petugas')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <form action="{{ route('petugas.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">

                    {{-- HEADER --}}
                    <div class="card-body text-center bg-light">
                        @if (auth()->user()->foto)
                            <img src="{{ asset('foto_petugas/' . auth()->user()->foto) }}"
                                 class="rounded-circle mb-3 border"
                                 width="120" height="120">
                        @else
                            <img src="{{ asset('default-avatar.png') }}"
                                 class="rounded-circle mb-3 border"
                                 width="120" height="120">
                        @endif

                        <input type="file" name="foto" class="form-control mt-2">
                        <small class="text-muted">Format JPG / PNG, max 2MB</small>
                    </div>

                    {{-- BODY --}}
                    <div class="card-body px-4">

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ auth()->user()->name }}">
                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer bg-white d-flex justify-content-end gap-2">
                        <a href="{{ route('petugas.profile.show') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
@endsection
