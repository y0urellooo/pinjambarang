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
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th width="180">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @forelse($peminjams as $p)
                <tr class="text-center">
                    {{ $peminjams->firstItem() + $loop->index }}

                    {{-- FOTO --}}
                    <td>
                        @if ($p->foto)
                            <img src="{{ asset('foto_peminjam/' . $p->foto) }}" 
                                 class="rounded" 
                                 width="50" height="50" alt="Foto {{ $p->name }}">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada peminjam
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- pagination -->
        <x-pagination :paginator="$peminjams" />
    </div>
</div>
@endsection
