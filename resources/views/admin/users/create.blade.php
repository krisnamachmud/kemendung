@extends('admin.layout')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User')

@section('content')
<div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div class="card-body">
        <div class="alert alert-info mb-4">
            <i class="fab fa-google"></i>
            <strong>Login via Google:</strong> User bisa login menggunakan tombol "Login dengan Google" tanpa perlu password.
            Password opsional untuk login manual.
        </div>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="user@email.com" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password (Opsional)</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Kosongkan jika hanya menggunakan Google login</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Role <span class="text-danger">*</span></label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="administrator" {{ old('role') == 'administrator' ? 'selected' : '' }}>Administrator</option>
                        <option value="kartar" {{ old('role', 'kartar') == 'kartar' ? 'selected' : '' }}>Kartar (Karang Taruna)</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">
                        <strong>Administrator:</strong> Akses semua menu |
                        <strong>Kartar:</strong> Hanya menu Kartar |
                        <strong>User:</strong> Tidak bisa akses admin
                    </small>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
