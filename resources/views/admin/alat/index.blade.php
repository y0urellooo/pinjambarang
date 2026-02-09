@extends('layouts.app')

@section('title', 'Data Alat')
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
                            <td>{{ $alats->firstItem() + $loop->index }}</td>

                            {{-- FOTO --}}
                            <td>
                                @if ($alat->foto)
                                    <img src="{{ asset('foto_alat/' . $alat->foto) }}" width="70" class="img-thumbnail">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>{{ $alat->nama_alat }}</td>
                            <td>{{ $alat->kategori->nama_kategori }}</td>


                            <td>{{ $alat->jumlah_alat }}</td>

                            {{-- DESKRIPSI --}}
                            <td class="text-start" style="max-width: 250px;">
                                @php
                                    $limit = 40;
                                    $isLong = strlen($alat->deskripsi) > $limit;
                                @endphp

                                <div class="deskripsi-wrapper">
                                    <span class="short-text">
                                        {{ \Illuminate\Support\Str::limit($alat->deskripsi, $limit) }}
                                    </span>

                                    @if ($isLong)
                                        <span class="full-text d-none">
                                            {{ $alat->deskripsi }}
                                        </span>

                                        <a href="javascript:void(0)" class="text-primary small d-block mt-1"
                                            onclick="toggleDeskripsi(this)">
                                            Lihat selengkapnya
                                        </a>
                                    @endif
                                </div>
                            </td>


                            <td>
                                <a href="{{ route('admin.alat.edit', $alat->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.alat.destroy', $alat->id) }}" method="POST" class="d-inline">
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

            <!-- pagination -->
            <x-pagination :paginator="$alats" />
        </div>
    </div>
@endsection