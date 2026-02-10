@extends('layouts.app')

@section('title', 'Tambah Alat')
@section('page_title', 'Tambah Alat')

@section('content')

<form action="{{ route('admin.alat.store') }}" method="POST" class="card" enctype="multipart/form-data">
    @csrf

    <div class="card-body">
        <h3 class="mb-4">Tambah Alat</h3>

        {{-- FOTO --}}
        <div class="mb-3">
            <label class="form-label">Foto Alat</label>
            <input type="file" name="foto" class="form-control">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- NAMA --}}
        <div class="mb-3">
            <label class="form-label">Nama Alat</label>
            <input type="text"
                   name="nama_alat"
                   class="form-control @error('nama_alat') is-invalid @enderror"
                   value="{{ old('nama_alat') }}" placeholder="Masukkan nama alat">
            @error('nama_alat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- KATEGORI --}}
        <div class="mb-3">
            <label class="form-label">Kategori</label>

            <div class="dropdown mb-2">
                <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start"
                        type="button"
                        data-bs-toggle="dropdown">
                    Pilih Kategori
                </button>

                <ul class="dropdown-menu w-100 px-3"
                    style="max-height:250px; overflow-y:auto;">
                    @foreach ($kategoris as $kategori)
                        <li>
                            <div class="form-check">
                                <input class="form-check-input kategori-checkbox"
                                       type="checkbox"
                                       name="kategori[]"
                                       value="{{ $kategori->id }}"
                                       data-nama="{{ $kategori->nama_kategori }}"
                                       {{ in_array($kategori->id, old('kategori', [])) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $kategori->nama_kategori }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- HASIL PILIHAN --}}
            <div id="kategori-terpilih" class="d-flex flex-wrap gap-2"></div>

            @error('kategori')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- STOK --}}
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number"
                   name="jumlah_alat"
                   class="form-control @error('jumlah_alat') is-invalid @enderror"
                   value="{{ old('jumlah_alat') }}"
                   min="0" placeholder="Masukkan stok alat">
            @error('jumlah_alat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- DESKRIPSI --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi"
                      class="form-control @error('deskripsi') is-invalid @enderror"
                      rows="3" placeholder="Masukkan deskripsi...">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary">Simpan</button>
            <a href="{{ route('admin.alat.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</form>

{{-- SCRIPT --}}
<script>
    function renderKategoriTerpilih() {
        const container = document.getElementById('kategori-terpilih');
        container.innerHTML = '';

        document.querySelectorAll('.kategori-checkbox:checked').forEach(cb => {
            const badge = document.createElement('span');
            badge.className = 'badge bg-primary';
            badge.innerText = cb.dataset.nama;
            container.appendChild(badge);
        });
    }

    document.querySelectorAll('.kategori-checkbox').forEach(cb => {
        cb.addEventListener('change', renderKategoriTerpilih);
    });

    // render saat load (old input)
    renderKategoriTerpilih();
</script>

@endsection
