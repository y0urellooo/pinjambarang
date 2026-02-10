@extends('layouts.app')

@section('title', 'Log Aktivitas')
@section('page_title', 'Log Aktivitas')

@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">

            <h3 class="mb-4">Log Aktivitas</h3>

            {{-- FILTER --}}
            <form method="GET" action="{{ route('admin.log.index') }}" class="row g-3 mb-4">
                <div class="col-md-3">
                    <label for="role" class="form-label fw-bold">Role</label>
                    <select name="role" id="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="peminjam" {{ request('role') == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="modul" class="form-label fw-bold">Modul</label>
                    <select name="modul" id="modul" class="form-select">
                        <option value="">Semua Modul</option>
                        @foreach ($moduls as $modul)
                            <option value="{{ $modul }}" {{ request('modul') == $modul ? 'selected' : '' }}>
                                {{ $modul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('admin.log.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            {{-- ALERT --}}
            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th width="60">No</th>
                            <th width="150">User</th>
                            <th width="100">Role</th>
                            <th width="120">Modul</th>
                            <th>Aktivitas</th>
                            <th width="160">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $index => $log)
                            <tr>
                                <td class="text-center">{{ $logs->firstItem() + $index }}</td>
                                <td class="fw-bold text-center">{{ $log->nama_user }}</td>
                                <td class="text-center">
                                    <span class="badge 
                                        {{ $log->role == 'admin' ? 'bg-danger' : '' }}
                                        {{ $log->role == 'petugas' ? 'bg-warning text-dark' : '' }}
                                        {{ $log->role == 'peminjam' ? 'bg-primary' : '' }}">
                                        {{ ucfirst($log->role) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">{{ $log->modul }}</span>
                                </td>
                                <td class="px-3" style="min-width: 250px;">
                                    {{ $log->aktivitas }}
                                </td>
                                <td class="text-center text-muted small">
                                    {{ $log->created_at->timezone('Asia/Jakarta')->format('d/m/Y') }}<br>
                                    <span class="fw-bold">
                                        {{ $log->created_at->timezone('Asia/Jakarta')->format('H:i') }} WIB
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada data aktivitas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-3">
                <x-pagination :paginator="$logs" />
            </div>

        </div>
    </div>

    {{-- AUTO HIDE ALERT --}}
    @if (session('success') || session('error'))
        <script>
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 500);
                });
            }, 3000);
        </script>
    @endif
@endsection
