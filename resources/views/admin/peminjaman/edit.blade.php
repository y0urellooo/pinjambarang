@extends('layouts.app')

@section('title', 'Edit Peminjaman')
@section('page_title', 'Edit Peminjaman')

@section('content')

<form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}"
      method="POST" class="card">
    @csrf
    @method('PUT')

    <div class="card-body">
        <h3 class="mb-4">Edit Peminjaman</h3>

        <div class="mb-3">
            <label class="form-label">Alat</label>
            <select name="alat_id" class="form-select" required>
                @foreach ($alats as $alat)
                    <option value="{{ $alat->id }}"
                        @selected($peminjaman->alat_id == $alat->id)>
                        {{ $alat->nama_alat }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam"
                   class="form-control"
                   value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}"
                   required>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
</form>
@endsection
