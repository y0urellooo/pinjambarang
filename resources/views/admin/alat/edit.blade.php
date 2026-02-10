@extends('layouts.app')

@section('title', 'Edit Alat')
@section('page_title', 'Edit Alat')

@section('content')

<form action="{{ route('admin.alat.update', $alat->id) }}"
      method="POST"
      class="card"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card-body">
        <h3 class="mb-4">Edit Alat</h3>

        {{-- FOTO --}}
        <div class="mb-4">
            <label class="form-label">Foto Alat</label>

            @if ($alat->foto)
                <img src="{{ asset('foto_alat/' . $alat->foto) }}"
                     class="img-thumbnail mb-2"
                     style="max-width:120px">
            @endif

            <input type="file" name="foto" class="form-control">
            <small class="text-muted">Kosongkan jika tidak diganti</small>
        </div>

        {{-- NAMA --}}
        <div class="mb-3">
            <label class="form-label">Nama Alat</label>
            <input type="text"
                   name="nama_alat"
                   class="form-control @error('nama_alat') is-invalid @enderror"
                   value="{{ old('nama_alat', $alat->nama_alat) }}">
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
                                       {{ $alat->kategoris->contains($kategori->id) ? 'checked' : '' }}>
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
        </div>

        {{-- STOK --}}
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number"
                   name="jumlah_alat"
                   class="form-control"
                   value="{{ old('jumlah_alat', $alat->jumlah_alat) }}"
                   min="0">
        </div>

        {{-- DESKRIPSI --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi"
                      class="form-control"
                      rows="3">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary">Update</button>
            <a href="{{ route('admin.alat.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</form>

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

    renderKategoriTerpilih();
</script>

@endsection
