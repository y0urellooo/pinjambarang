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
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @forelse($peminjams as $p)
                <tr class="text-center">
                    <td>{{ $peminjams->firstItem() + $loop->index }}</td>

                    {{-- FOTO --}}
                    <td>
                        @if ($p->foto)
                            <img src="{{ asset('foto_peminjam/' . $p->foto) }}"
                                 class="rounded"
                                 width="50" height="50">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>

                    {{-- AKSI --}}
                    <td>
                        <form 
                            action="{{ route('admin.peminjam.toggleStatus', $p->id) }}" 
                            method="POST"
                            class="form-toggle-status"
                            data-status="{{ $p->status }}"
                        >
                            @csrf
                            @method('PATCH')

                            @if($p->status == 'active')
                                <button class="btn btn-danger btn-sm">
                                    Nonaktifkan
                                </button>
                            @else
                                <button class="btn btn-success btn-sm">
                                    Aktifkan
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada peminjam
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-3">
            <x-pagination :paginator="$peminjams" />
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.querySelectorAll('.form-toggle-status').forEach(form => {
    form.addEventListener('submit', function(e) {
        const status = this.dataset.status;
        const message = status === 'active'
            ? 'Yakin ingin menonaktifkan peminjam ini?'
            : 'Yakin ingin mengaktifkan peminjam ini?';

        if (!confirm(message)) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
