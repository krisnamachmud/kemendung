@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-circle fa-4x text-primary mb-3"></i>
                        <h3 class="fw-bold">Login</h3>
                        <p class="text-muted">Masuk ke akun Anda</p>
                    </div>

                    @if($errors->has('login'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ $errors->first('login') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('user.login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" placeholder="nama@email.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   placeholder="Masukkan password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>

                    <div class="text-center my-3">
                        <span class="text-muted">atau</span>
                    </div>

                    <a href="{{ route('user.google.redirect') }}" class="btn btn-outline-danger btn-lg w-100 mb-4">
                        <i class="fab fa-google"></i> Login dengan Google
                    </a>

                    <hr>

                    <div class="text-center">
                        <p class="mb-2">Belum punya akun?</p>
                        <a href="{{ route('user.register') }}" class="btn btn-success">
                            <i class="fas fa-user-plus"></i> Daftar Sekarang
                        </a>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('home') }}" class="text-muted">
                            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

            {{-- Link ke Admin Login --}}
            <div class="text-center mt-4">
                <a href="{{ route('admin.login') }}" class="text-muted small">
                    <i class="fas fa-lock"></i> Login sebagai Admin
                </a>
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
    .btn-success {
        background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
        border: none;
    }
    .btn-success:hover {
        background: linear-gradient(135deg, #219a52 0%, #1a7a41 100%);
    }
</style>
@endsection
