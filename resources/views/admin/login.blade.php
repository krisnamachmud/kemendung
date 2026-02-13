<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Dusun Kemendung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a5f4a 0%, #2d7d63 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            width: 100%;
            max-width: 450px;
        }
        .login-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h1 {
            color: #1a5f4a;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .login-header p {
            color: #999;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px 15px;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #1a5f4a;
            box-shadow: 0 0 0 0.2rem rgba(26, 95, 74, 0.25);
        }
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #1a5f4a 0%, #2d7d63 100%);
            border: none;
            padding: 12px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(26, 95, 74, 0.4);
        }
        .error-alert {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: #1a5f4a;
            text-decoration: none;
            font-weight: 500;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>🔐 Admin Panel</h1>
                <p>Dusun Kemendung Tikung Lamongan</p>
            </div>

            @if ($errors->has('login'))
                <div class="error-alert">
                    {{ $errors->first('login') }}
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <div style="text-align: center; margin: 20px 0; position: relative;">
                <hr style="border-color: #eee;">
                <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 0 15px; color: #999; font-size: 13px;">atau</span>
            </div>

            <a href="{{ route('admin.google.redirect') }}" class="btn-google" style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 5px; background: white; color: #333; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s;">
                <svg width="20" height="20" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
                Login dengan Google
            </a>

            <style>
                .btn-google:hover {
                    border-color: #4285F4;
                    box-shadow: 0 2px 10px rgba(66, 133, 244, 0.3);
                    transform: translateY(-1px);
                }
            </style>

            <div class="footer-text">
                <p style="color: #999; font-size: 12px; margin-top: 15px;">Login menggunakan akun Google yang sudah didaftarkan oleh admin</p>
            </div>

            <div class="back-link">
                <a href="{{ route('home') }}">← Kembali ke Website</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
