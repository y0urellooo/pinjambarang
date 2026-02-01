@extends('layouts.app')

@section('title', 'Manajemen User')
@section('page_title', 'User')

@section('content')
<h3 class="mb-4">Data User</h3>

<!-- alert -->
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

<a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">
    + Tambah User
</a>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th width="80">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th width="120">Role</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                            class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        @if($user->role !== 'admin')
                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                            method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus user?')"
                                class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                        @else
                        <span class="badge bg-secondary">Admin</span>
                        @endif

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        tidak ada user
                        @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- notif 3 detik -->
@if (session('success'))
<script>
    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) alert.remove();
    }, 3000);
</script>
@endif

@if (session('error'))
<script>
    setTimeout(() => {
        const alert = document.getElementById('error-alert');
        if (alert) alert.remove();
    }, 3000);
</script>
@endif
@endsection