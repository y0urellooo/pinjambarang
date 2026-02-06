@extends('layouts.app')

@section('page_title', 'Edit Profil')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <form action="{{ route('peminjam.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">

                    {{-- HEADER --}}
                    <div class="card-body text-center bg-light">
                        @if (auth()->user()->foto)
                            <img src="{{ asset('foto_peminjam/' . auth()->user()->foto) }}"
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
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ auth()->user()->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No Telpon</label>
                            <input type="text" name="no_telpon" class="form-control"
                                   value="{{ auth()->user()->no_telpon }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select">
                                <option value="laki-laki" {{ auth()->user()->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="perempuan" {{ auth()->user()->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ auth()->user()->alamat }}</textarea>
                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer bg-white d-flex justify-content-end gap-2">
                        <a href="{{ route('peminjam.profile') }}" class="btn btn-outline-secondary">
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
