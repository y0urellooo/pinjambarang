@extends('layouts.app')

@section('page_title', 'Alat')

@section('content')
    <h3 class="mb-4">Data Alat</h3>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <a href="{{ route('admin.alat.create') }}" class="btn btn-primary mb-3">
        + Tambah Alat
    </a>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alats as $alat)
                        <tr class="text-center align-middle">
                            <td>{{ $loop->iteration }}</td>

                            {{-- FOTO --}}
                            <td>
                                @if ($alat->foto)
                                    <img src="{{ asset('foto_alat/' . $alat->foto) }}" alt="{{ $alat->nama_alat }}" width="70" height="70" class="img-thumbnail" style="object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/cangkul.jpg') }}" alt="Default Alat" width="70" height="70" class="img-thumbnail" style="object-fit: cover;">
                                @endif
                            </td>


                            <td>{{ $alat->nama_alat }}</td>
                            <td>{{ $alat->kategori->nama_kategori }}</td>


                            <td>{{ $alat->jumlah_alat }}</td>

                            {{-- DESKRIPSI --}}
                            <td class="text-start">
                                {{ $alat->deskripsi ?? '-' }}
                            </td>

                            <td>
                                <a href="{{ route('admin.alat.edit', $alat->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.alat.destroy', $alat->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus barang ini?')" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Data barang masih kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
