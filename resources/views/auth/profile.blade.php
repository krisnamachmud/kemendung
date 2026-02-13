@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" 
                                 class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <i class="fas fa-user-circle fa-5x text-primary mb-3"></i>
                        @endif
                        <h3 class="fw-bold">{{ $user->name }}</h3>
                        <span class="badge bg-{{ $user->role_badge }}">{{ $user->role_label }}</span>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                            <input type="text" name="name" class="form-control form-control-lg" 
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" 
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <hr class="my-4">

                        <p class="text-muted small"><i class="fas fa-info-circle"></i> Kosongkan password jika tidak ingin mengubah</p>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-lock"></i> Password Baru</label>
                            <input type="password" name="password" class="form-control form-control-lg" 
                                   placeholder="Minimal 6 karakter">
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-lock"></i> Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" 
                                   placeholder="Ulangi password baru">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </form>

                    @if($user->google_id)
                        <div class="alert alert-success mt-4 mb-0">
                            <i class="fab fa-google"></i> Akun terhubung dengan Google
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ route('home') }}" class="text-muted">
                            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        background: white;
    }
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }
    .btn-primary {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #2980b9 0%, #1a5276 100%);
    }
</style>
@endsection
