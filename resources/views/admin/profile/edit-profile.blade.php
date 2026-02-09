@extends('layouts.app')

@section('page_title', 'Edit Profil Admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="{{ route('admin.profile.update') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center bg-light">
                        @if (auth()->user()->foto)
                            <img src="{{ asset('foto_admin/' . auth()->user()->foto) }}"
                                 class="rounded-circle mb-3 border"
                                 width="120" height="120">
                        @else
                            <img src="{{ asset('default-avatar.png') }}"
                                 class="rounded-circle mb-3 border"
                                 width="120" height="120">
                        @endif

                        <input type="file" name="foto" class="form-control mt-2">
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   value="{{ auth()->user()->name }}">
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('admin.profile.show') }}"
                           class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
@endsection
