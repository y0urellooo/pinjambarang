@extends('layouts.app')

@section('title', 'Data Petugas')
@section('page_title', 'Petugas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-semibold mb-1">Data Petugas</h3>
        <small class="text-muted">Kelola akun petugas yang bertugas</small>
    </div>

    <a href="{{ route('admin.petugas.create') }}"
       class="btn btn-primary rounded-pill px-4">
        <i class="bi bi-plus-circle me-1"></i> Tambah Petugas
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm" id="success-alert">
    <i class="bi bi-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow-lg rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-dark text-white text-center">
                    <tr>
                        <th width="70">No</th>
                        <th class="text-start">Nama Petugas</th>
                        <th class="text-start">Email</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($petugas as $p)
                    <tr class="text-center">
                        <td class="fw-semibold">{{ $loop->iteration }}</td>

                        <td class="text-start">
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                     style="width:36px;height:36px;">
                                    {{ strtoupper(substr($p->name, 0, 1)) }}
                                </div>
                                <span class="fw-semibold">{{ $p->name }}</span>
                            </div>
                        </td>

                        <td class="text-start text-muted">
                            {{ $p->email }}
                        </td>

                        <td>
                            <a href="{{ route('admin.petugas.edit', $p->id) }}"
                               class="btn btn-warning btn-sm rounded-pill px-3">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>

                            <form action="{{ route('admin.petugas.destroy', $p->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus petugas?')"
                                        class="btn btn-danger btn-sm rounded-pill px-3">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="bi bi-people fs-3 d-block mb-2"></i>
                            Belum ada data petugas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- auto hide notif --}}
@if(session('success'))
<script>
    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) alert.remove();
    }, 3000);
</script>
@endif
@endsection
