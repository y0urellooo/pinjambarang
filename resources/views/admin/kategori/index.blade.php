@extends('layouts.app')

@section('title', 'Data Kategori')
@section('page_title', 'Kategori')

@section('content')
<h3 class="mb-4">Data Kategori</h3>

<a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3">
    + Tambah Kategori
</a>

@if (session('success'))
<div class="alert alert-success" id="success-alert">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger" id="error-alert">
    {{ session('error') }}
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-bordered mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th width="100">No</th>
                    <th>Nama Kategori</th>
                    <th width="280">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategoris as $kategori)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                            class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus data?')"
                                class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        Belum ada kategori
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- notif 3 detik -->
@if (session('error'))
<script>
    setTimeout(() => {
        const alert = document.getElementById('error-alert');
        if (alert) alert.remove();
    }, 3000);
</script>
@endif

@if (session('success'))
<script>
    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.add('fade');
            alert.classList.remove('show');
            alert.remove();
        }
    }, 3000);
</script>
@endif
@endsection