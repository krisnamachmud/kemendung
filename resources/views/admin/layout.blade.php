<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Dusun Kemendung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar */
        .admin-sidebar {
            width: 250px;
            background: linear-gradient(180deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        .admin-content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
            min-width: 0;
        }
        .sidebar-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sidebar-header h2 {
            font-size: 20px;
            margin: 0;
            font-weight: bold;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu li {
            margin-bottom: 8px;
        }
        .sidebar-menu a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s;
            font-size: 14px;
        }
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        .sidebar-menu i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        /* Hamburger toggle */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 12px;
            left: 12px;
            z-index: 1100;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            width: 40px;
            height: 40px;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            align-items: center;
            justify-content: center;
        }
        .sidebar-close {
            display: none;
            position: absolute;
            top: 15px;
            right: 15px;
            background: transparent;
            border: none;
            color: white;
            font-size: 22px;
            cursor: pointer;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .sidebar-overlay.show { display: block; }
        /* Header */
        .admin-header {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            flex-wrap: wrap;
            gap: 10px;
        }
        .admin-header h1 {
            margin: 0;
            color: #3498db;
            font-size: 22px;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .user-menu a {
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
        }
        .user-menu a:hover { text-decoration: underline; }
        .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
        }
        .btn-logout:hover { background: #c82333; }
        /* Cards & Tables */
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
        }
        .btn-primary {
            background: #3498db;
            border-color: #3498db;
        }
        .btn-primary:hover {
            background: #2980b9;
            border-color: #2980b9;
        }
        .btn-danger { background: #dc3545; }
        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead { background: #f8f9fa; }

        /* Tablet */
        @media (max-width: 992px) {
            .admin-sidebar { width: 220px; }
            .admin-content { margin-left: 220px; padding: 15px; }
        }

        /* Mobile */
        @media (max-width: 768px) {
            .sidebar-toggle { display: flex; }
            .sidebar-close { display: block; }
            .admin-sidebar {
                width: 270px;
                transform: translateX(-100%);
                box-shadow: 4px 0 15px rgba(0,0,0,0.2);
            }
            .admin-sidebar.open {
                transform: translateX(0);
            }
            .admin-content {
                margin-left: 0;
                padding: 15px;
                padding-top: 60px;
            }
            .admin-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .admin-header h1 { font-size: 18px; }
            .user-menu {
                width: 100%;
                justify-content: space-between;
            }
            /* Dashboard cards: 2 kolom di tablet kecil */
            .dashboard-cards .col-md-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* Small mobile */
        @media (max-width: 480px) {
            .admin-content { padding: 10px; padding-top: 55px; }
            .admin-header { padding: 12px 15px; }
            .admin-header h1 { font-size: 16px; }
            .card-body { padding: 12px; }
            .card h5 { font-size: 13px; }
            .card h2 { font-size: 22px; }
            /* Dashboard cards: 1 kolom di hp kecil */
            .dashboard-cards .col-md-3,
            .dashboard-cards .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .table { font-size: 13px; }
            .table td, .table th { padding: 8px 6px; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Hamburger toggle button (mobile only) -->
    <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <div class="admin-wrapper">
        <!-- Sidebar -->
        <div class="admin-sidebar" id="adminSidebar">
            <button class="sidebar-close" onclick="closeSidebar()">
                <i class="fas fa-times"></i>
            </button>
            <div class="sidebar-header">
                <h2><i class="fas fa-cog"></i> Admin</h2>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('home') }}" class="" style="background: rgba(46, 204, 113, 0.3); border: 1px solid rgba(46, 204, 113, 0.5);">
                        <i class="fas fa-globe"></i>
                        <span>Lihat Website</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="@if (request()->routeIs('admin.dashboard')) active @endif">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- Menu khusus Administrator --}}
                @php
                    $user = \App\Models\User::find(session('admin_id'));
                @endphp

                @if($user && $user->isAdministrator())
                <li>
                    <a href="{{ route('admin.berita.index') }}" class="@if (request()->routeIs('admin.berita.*')) active @endif">
                        <i class="fas fa-newspaper"></i>
                        <span>Berita</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.perangkat.index') }}" class="@if (request()->routeIs('admin.perangkat.*')) active @endif">
                        <i class="fas fa-users"></i>
                        <span>Perangkat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.statistik.edit') }}" class="@if (request()->routeIs('admin.statistik.*')) active @endif">
                        <i class="fas fa-chart-bar"></i>
                        <span>Statistik</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.umkm.index') }}" class="@if (request()->routeIs('admin.umkm.*')) active @endif">
                        <i class="fas fa-store"></i>
                        <span>UMKM</span>
                    </a>
                </li>
                @endif

                {{-- Menu Kartar - bisa diakses Administrator & Kartar --}}
                @if($user && ($user->isAdministrator() || $user->isKartar()))
                <li style="margin-top: 15px;">
                    <small class="text-white-50 px-3">KARANG TARUNA</small>
                </li>
                <li>
                    <a href="{{ route('admin.kartar.index') }}" class="@if (request()->routeIs('admin.kartar.*')) active @endif">
                        <i class="fas fa-users-gear"></i>
                        <span>Kartar Anggota</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kartar-kegiatan.index') }}" class="@if (request()->routeIs('admin.kartar-kegiatan.*')) active @endif">
                        <i class="fas fa-calendar-check"></i>
                        <span>Kartar Kegiatan</span>
                    </a>
                </li>
                @endif

                {{-- Menu khusus Administrator --}}
                @if($user && $user->isAdministrator())
                <li style="margin-top: 15px;">
                    <small class="text-white-50 px-3">LAINNYA</small>
                </li>
                <li>
                    <a href="{{ route('admin.kritik-saran.index') }}" class="@if (request()->routeIs('admin.kritik-saran.*')) active @endif">
                        <i class="fas fa-comments"></i>
                        <span>Kritik & Saran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="@if (request()->routeIs('admin.users.*')) active @endif">
                        <i class="fas fa-user-shield"></i>
                        <span>Kelola User</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>

        <!-- Content -->
        <div class="admin-content">
            <!-- Header -->
            <div class="admin-header">
                <h1>@yield('page-title', 'Dashboard')</h1>
                <div class="user-menu">
                    @if(session('admin_avatar'))
                        <img src="{{ session('admin_avatar') }}" alt="" style="width: 28px; height: 28px; border-radius: 50%; margin-right: 5px; vertical-align: middle;">
                    @else
                        👤
                    @endif
                    <span>{{ session('admin_name') }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Alerts -->
            @if ($message = session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> Ada error pada form
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Main Content -->
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        // Sidebar toggle for mobile
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
        function closeSidebar() {
            document.getElementById('adminSidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('show');
        }
        // Auto-close sidebar when clicking a menu link (mobile)
        document.querySelectorAll('.sidebar-menu a').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) closeSidebar();
            });
        });

        function validateFileSize(input, maxMB) {
            if (input.files && input.files[0]) {
                var fileSize = input.files[0].size / 1024 / 1024;
                if (fileSize > maxMB) {
                    alert('Ukuran file terlalu besar! Maksimal ' + maxMB + 'MB. File Anda: ' + fileSize.toFixed(2) + 'MB');
                    input.value = '';
                    return;
                }
            }
        }

        // Image Upload Preview for Admin Forms
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[type="file"][accept*="image"]').forEach(function(input) {
                input.addEventListener('change', function() {
                    var file = this.files[0];
                    var existingPreview = this.parentNode.querySelector('.admin-img-preview');
                    
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            alert('Ukuran file terlalu besar! Maksimal 2MB');
                            this.value = '';
                            return;
                        }
                        
                        var reader = new FileReader();
                        var inputEl = this;
                        reader.onload = function(e) {
                            var previewDiv = document.createElement('div');
                            previewDiv.className = 'admin-img-preview';
                            previewDiv.style.cssText = 'margin-top: 10px; position: relative; display: inline-block;';
                            previewDiv.innerHTML = 
                                '<img src="' + e.target.result + '" style="max-width: 250px; max-height: 200px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.15); animation: adminPreviewFadeIn 0.5s ease;" alt="Preview">' +
                                '<button type="button" onclick="this.parentNode.remove(); document.getElementById(\'' + inputEl.id + '\').value = \'\';" style="position: absolute; top: -8px; right: -8px; width: 28px; height: 28px; background: #e74c3c; color: white; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 14px; box-shadow: 0 2px 8px rgba(231,76,60,0.4);">&times;</button>';
                            inputEl.parentNode.appendChild(previewDiv);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>
    <style>
        @keyframes adminPreviewFadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
    @yield('scripts')
</body>
</html>
