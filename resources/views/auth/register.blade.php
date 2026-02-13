@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-plus fa-4x text-success mb-3"></i>
                        <h3 class="fw-bold">Daftar Akun</h3>
                        <p class="text-muted">Buat akun baru untuk bergabung</p>
                    </div>

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

                    <form action="{{ route('user.register.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" placeholder="nama@email.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   placeholder="Minimal 6 karakter" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-lock"></i> Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" 
                                   placeholder="Ulangi password" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100 mb-3">
                            <i class="fas fa-user-plus"></i> Daftar
                        </button>
                    </form>

                    <div class="text-center my-3">
                        <span class="text-muted">atau</span>
                    </div>

                    <a href="{{ route('user.google.redirect') }}" class="btn btn-outline-danger btn-lg w-100 mb-4">
                        <i class="fab fa-google"></i> Daftar dengan Google
                    </a>

                    <hr>

                    <div class="text-center">
                        <p class="mb-2">Sudah punya akun?</p>
                        <a href="{{ route('user.login') }}" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </div>

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
        border-color: #27ae60;
        box-shadow: 0 0 0 0.2rem rgba(39, 174, 96, 0.25);
    }
    .btn-primary {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #2980b9 0%, #1a5276 100%);
    }
    .btn-success {
        background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
        border: none;
    }
    .btn-success:hover {
        background: linear-gradient(135deg, #219a52 0%, #1a7a41 100%);
    }
</style>
@endsection
