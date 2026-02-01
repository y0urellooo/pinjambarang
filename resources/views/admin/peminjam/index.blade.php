@extends('layouts.app')

@section('title', 'Data Peminjam')
@section('page_title', 'Peminjam')

@section('content')
<h3 class="mb-4">Data Peminjam</h3>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th width="80">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th width="180">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjams as $p)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Belum ada peminjam
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
