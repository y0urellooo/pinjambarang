@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<h2>Data Kategori</h2>

<a href="{{ route('admin.kategori.create') }}">+ Tambah Kategori</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>

    @foreach($kategoris as $kategori)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $kategori->nama }}</td>
        <td>{{ $kategori->deskripsi }}</td>
        <td>
            <a href="{{ route('admin.kategori.edit', $kategori->id) }}">Edit</a>

            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                  method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus kategori?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
