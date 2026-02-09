@extends('layouts.app')

@section('title', 'Log Aktivitas')
@section('page_title', 'Log Aktivitas')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">
        <h3 class="fw-bold mb-1">Riwayat Aktivitas</h3>
        <small class="text-muted">
            Catatan login, CRUD data, peminjaman, pengembalian, konfirmasi & penolakan
        </small>
    </div>

    {{-- FILTER --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.activity-logs.index') }}"
                  class="row g-3 justify-content-center align-items-end">

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-center d-block">User</label>
                    <select name="user_id" class="form-select text-center">
                        <option value="">Semua</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-center d-block">Tipe Aktivitas</label>
                    <select name="activity_type" class="form-select text-center">
                        <option value="">Semua</option>
                        @foreach($activityTypes as $key => $label)
                            <option value="{{ $key }}" {{ request('activity_type') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center mb-0">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama User</th>
                            <th>Modul</th>
                            <th>Aktivitas</th>
                            <th width="160">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>

@php
    $moduleMap = [
        'kategori'     => 'Kategori',
        'alat'         => 'Alat',
        'peminjam'     => 'Peminjam',
        'peminjaman'   => 'Peminjaman',
        'pengembalian' => 'Pengembalian',
        'user'         => 'User',
        'auth'         => 'Auth',
    ];
@endphp

@forelse ($activityLogs as $log)
@php
    $rawModule = strtolower($log->module ?? '');

    if ($rawModule && isset($moduleMap[$rawModule])) {
        $module = $moduleMap[$rawModule];
    } elseif ($log->model_type) {
        $model = strtolower(class_basename($log->model_type));
        $module = $moduleMap[$model] ?? ucfirst($model);
    } else {
        $module = 'Lainnya';
    }
@endphp
                        <tr>
                            <td>
                                {{ $activityLogs->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $log->user?->name ?? 'Unknown' }}
                                </div>
                                <small class="text-muted text-capitalize">
                                    {{ $log->user?->role ?? '-' }}
                                </small>
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2">
                                    {{ $module }}
                                </span>
                            </td>

                            <td>
                                <span class="badge px-3 py-2 bg-{{ $log->getActivityTypeBadgeColor() }}">
                                    {{ $log->actionLabel() }}
                                </span>
                            </td>

                            <td class="text-muted">
                                <small>
                                    {{ $log->created_at->format('d M Y') }}<br>
                                    {{ $log->created_at->format('H:i') }}
                                </small>
                            </td>
                        </tr>
@empty
                        <tr>
                            <td colspan="5" class="text-muted py-4">
                                Belum ada aktivitas
                            </td>
                        </tr>
@endforelse

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.activity-logs.export') }}" class="btn btn-sm btn-outline-success">
                Export CSV
            </a>

            {{ $activityLogs->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection
