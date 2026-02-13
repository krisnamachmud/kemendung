@extends('admin.layout')

@section('title', 'Kelola User')
@section('page-title', 'Kelola User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar User</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah User
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div class="card-body">
        <div class="alert alert-info mb-3">
            <i class="fas fa-info-circle"></i>
            <strong>Keterangan Role:</strong><br>
            <span class="badge bg-danger">Administrator</span> Akses semua menu admin |
            <span class="badge bg-primary">Kartar</span> Hanya akses menu Kartar |
            <span class="badge bg-secondary">User</span> Tidak bisa akses admin
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead style="background: #3498db; color: white;">
                    <tr>
                        <th>No</th>
                        <th>Avatar</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Google</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            @else
                                <div style="width: 40px; height: 40px; background: #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->google_id)
                                <span class="badge bg-success"><i class="fab fa-google"></i> Terhubung</span>
                            @else
                                <span class="badge bg-secondary">Belum</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $user->role_badge }}">
                                @if($user->role == 'administrator')
                                    <i class="fas fa-shield-alt"></i>
                                @elseif($user->role == 'kartar')
                                    <i class="fas fa-users"></i>
                                @else
                                    <i class="fas fa-user"></i>
                                @endif
                                {{ $user->role_label }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada user terdaftar</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
