@extends('admin.layout')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Role <span class="text-danger">*</span></label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="administrator" {{ old('role', $user->role) == 'administrator' ? 'selected' : '' }}>Administrator</option>
                        <option value="kartar" {{ old('role', $user->role) == 'kartar' ? 'selected' : '' }}>Kartar (Karang Taruna)</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">
                        <strong>Administrator:</strong> Akses semua menu |
                        <strong>Kartar:</strong> Hanya menu Kartar |
                        <strong>User:</strong> Tidak bisa akses admin
                    </small>
                </div>
            </div>

            @if($user->google_id)
            <div class="alert alert-success">
                <i class="fab fa-google"></i> Akun Google terhubung
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="" style="width: 24px; height: 24px; border-radius: 50%; margin-left: 5px;">
                @endif
            </div>
            @endif

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
