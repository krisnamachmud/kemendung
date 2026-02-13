<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon - Tambahkan di sini -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --accent-color: #85c1e2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 10px 0;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
            color: white !important;
        }

        /* Hamburger always visible */
        .navbar-toggler {
            display: flex !important;
            border: 2px solid rgba(255,255,255,0.5);
            padding: 6px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(255,255,255,0.25);
        }

        .navbar-toggler:hover {
            border-color: rgba(255,255,255,0.9);
            background: rgba(255,255,255,0.1);
        }

        .navbar-toggler-icon {
            width: 1.2em;
            height: 1.2em;
        }

        /* Always collapse the nav */
        .navbar-collapse {
            display: none !important;
            width: 100%;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.35s ease;
        }

        .navbar-collapse.show {
            display: block !important;
            max-height: 500px;
        }

        .navbar-collapse ul.navbar-nav {
            flex-direction: column;
            padding: 15px 0 10px;
            gap: 2px;
        }

        .nav-link {
            color: white !important;
            transition: all 0.3s;
            padding: 10px 15px !important;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: var(--accent-color) !important;
        }

        /* Admin Login Button */
        .btn-admin-login {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%) !important;
            color: white !important;
            padding: 10px 16px !important;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            margin-top: 5px;
        }

        .btn-admin-login:hover {
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%) !important;
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.4);
            color: white !important;
        }

        .btn-admin-login i {
            font-size: 14px;
        }

        /* User Login Button */
        .btn-login {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%) !important;
            color: white !important;
            padding: 10px 16px !important;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            margin-top: 5px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #219a52 0%, #1a7a41 100%) !important;
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.4);
            color: white !important;
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            background: white;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border-radius: 10px;
            padding: 10px 0;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
        }

        .dropdown-item i {
            width: 20px;
            margin-right: 8px;
        }

        .running-text {
            background: var(--accent-color);
            color: white;
            padding: 10px;
            overflow: hidden;
            font-weight: 500;
        }

        .running-text-content {
            display: flex;
            animation: scroll-left 15s linear infinite;
        }

        @keyframes scroll-left {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(26, 95, 74, 0.7), rgba(45, 125, 99, 0.7)),
                        url('{{ asset("images/image.png") }}') center/cover;
            color: white;
            padding: 100px 0;
            text-align: center;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .btn-primary-custom {
            background: var(--accent-color);
            border: none;
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 5px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            background: #e67e22;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.4);
            color: white;
        }

        /* Section */
        section {
            padding: 60px 0;
        }

        section h2 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 20px;
        }

        section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        /* Card */
        .card {
            border: none;
            border-radius: 10px;
            transition: all 0.3s;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .card-body {
            padding: 25px;
        }

        .card h5 {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Statistik */
        .stat-box {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-label {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }

        footer h5 {
            color: var(--accent-color);
            font-weight: 600;
            margin-bottom: 20px;
        }

        footer a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: var(--accent-color);
        }

        .footer-bottom {
            border-top: 1px solid #34495e;
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero {
                min-height: 350px;
                padding: 60px 0;
            }

            .hero h1 {
                font-size: 1.6rem;
            }

            .hero p {
                font-size: 0.95rem;
            }

            section {
                padding: 35px 0;
            }

            section h2 {
                font-size: 1.4rem;
                margin-bottom: 25px;
            }

            .stat-box {
                padding: 20px 15px;
            }

            .stat-number {
                font-size: 1.8rem;
            }

            .stat-label {
                font-size: 0.85rem;
            }

            .card-body {
                padding: 15px;
            }

            footer {
                padding: 30px 0 15px;
                margin-top: 30px;
            }

            footer .col-md-4 {
                margin-bottom: 20px;
            }

            .map-container {
                height: 180px;
            }

            .running-text {
                font-size: 0.85rem;
                padding: 8px;
            }

            .btn-primary-custom {
                padding: 10px 22px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .hero {
                min-height: 280px;
                padding: 45px 0;
            }

            .hero h1 {
                font-size: 1.35rem;
            }

            .hero p {
                font-size: 0.85rem;
                margin-bottom: 20px;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }

            section {
                padding: 25px 0;
            }

            section h2 {
                font-size: 1.2rem;
                margin-bottom: 20px;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            footer h5 {
                font-size: 1rem;
            }
        }

        /* Loading Screen */
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-content {
            text-align: center;
            color: white;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(255,255,255,0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Navbar Scroll Effect */
        .navbar {
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(26, 95, 74, 0.95) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            padding: 5px 0;
        }

        /* Map Container Styles */
        .map-container {
            position: relative;
            height: 250px;
            border-radius: 12px;
            margin-top: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
            transition: all 0.3s ease;
        }

        .map-expand-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            z-index: 10;
            cursor: pointer;
            border: none;
            padding: 8px;
        }

        .map-expand-btn img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: all 0.3s ease;
        }

        .map-expand-btn:hover {
            background: var(--primary-color);
            transform: scale(1.1);
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        .map-expand-btn:hover img {
            filter: brightness(0) invert(1);
        }

        /* Map Modal Styles - Animate from small map position */
        .map-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0);
            z-index: 99999;
            pointer-events: none;
            visibility: hidden;
            transition: background 0.4s ease, visibility 0s linear 0.4s;
        }

        .map-modal.active {
            background: rgba(0, 0, 0, 0.9);
            pointer-events: auto;
            visibility: visible;
            transition: background 0.8s ease, visibility 0s linear 0s;
        }

        .map-modal-content {
            position: fixed;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0,0,0,0.5);
            /* Super smooth animation */
            transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .map-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .map-modal-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .map-modal-close {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            padding: 8px;
        }

        .map-modal-close img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .map-modal-close:hover {
            background: rgba(255,255,255,0.3);
            transform: scale(1.1);
        }

        .map-modal-body {
            height: calc(100% - 70px);
        }

        .map-modal-body iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        @media (max-width: 768px) {
            .map-modal-content {
                width: 95%;
                height: 80%;
            }
        }

        /* Card Hover Effects Enhanced */
        .card {
            border: none;
            border-radius: 15px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
            z-index: 1;
        }

        .card:hover::before {
            left: 100%;
        }

        /* Stat Box Animation */
        .stat-box {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .stat-box:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 35px rgba(26, 95, 74, 0.4);
        }

        .stat-box::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse-bg 3s ease-in-out infinite;
        }

        @keyframes pulse-bg {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
            position: relative;
            z-index: 2;
        }

        .stat-label {
            font-size: 0.95rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        /* Button Effects */
        .btn-primary-custom {
            background: var(--accent-color);
            border: none;
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: 0.5s;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            background: #e67e22;
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 30px rgba(243, 156, 18, 0.5);
            color: white;
        }

        /* Hero Parallax Effect */
        .hero {
            background: linear-gradient(rgba(26, 95, 74, 0.7), rgba(45, 125, 99, 0.7)),
                        url('{{ asset("images/image.png") }}') center/cover fixed;
            color: white;
            padding: 100px 0;
            text-align: center;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            animation: fadeInUp 1s ease;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            animation: fadeInUp 1s ease 0.3s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Floating Animation for Icons */
        .stat-box i {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Section Title Animation */
        section h2 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 20px;
        }

        section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 2px;
            transition: width 0.5s ease;
        }

        section:hover h2::after {
            width: 120px;
        }

        /* Footer Link Hover */
        footer a {
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: width 0.3s ease;
        }

        footer a:hover::after {
            width: 100%;
        }

        footer a:hover {
            color: var(--accent-color);
            padding-left: 5px;
        }

        /* Social Media Icons */
        footer .fab {
            transition: all 0.3s ease;
        }

        footer a:hover .fab {
            transform: scale(1.3) rotate(10deg);
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
            40% { transform: translateX(-50%) translateY(-20px); }
            60% { transform: translateX(-50%) translateY(-10px); }
        }

        /* Image Zoom on Hover */
        .card-img-top {
            transition: transform 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        /* Badge Animation */
        .badge {
            transition: all 0.3s ease;
        }

        .card:hover .badge {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Loading Screen -->
    <div id="loader">
        <div class="loader-content">
            <div class="spinner"></div>
            <p>Memuat...</p>
        </div>
    </div>

    <!-- Map Modal -->
    <div class="map-modal" id="mapModal">
        <div class="map-modal-content">
            <div class="map-modal-header">
                <h5><i class="fas fa-map-marker-alt"></i> Lokasi Dusun Kemendung</h5>
                <button class="map-modal-close" id="closeMapModal" title="Kecilkan">
                    <img src="{{ asset('minimize.svg') }}" alt="Minimize">
                </button>
            </div>
            <div class="map-modal-body">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15833.819976090748!2d112.41030300000004!3d-7.188810452379681!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77f7eb1226e859%3A0x2e9248c88b377150!2sTikung%2C%20Lamongan%20Regency%2C%20East%20Java%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1770237754082!5m2!1sen!2sus"
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-map-location-dot"></i> Dusun Kemendung
            </a>
            <button class="navbar-toggler" type="button" id="navToggler" onclick="toggleNav()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('berita*') ? 'active' : '' }}" href="{{ route('berita') }}">
                            <i class="fas fa-newspaper"></i> Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('perangkat') ? 'active' : '' }}" href="{{ route('perangkat') }}">
                            <i class="fas fa-users"></i> Perangkat Desa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('statistik') ? 'active' : '' }}" href="{{ route('statistik') }}">
                            <i class="fas fa-chart-bar"></i> Statistik
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('umkm*') ? 'active' : '' }}" href="{{ route('umkm.index') }}">
                            <i class="fas fa-store"></i> UMKM
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kartar*') ? 'active' : '' }}" href="{{ route('kartar.index') }}">
                            <i class="fas fa-people-group"></i> Kartar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kritik-saran*') ? 'active' : '' }}" href="{{ route('kritik-saran.index') }}">
                            <i class="fas fa-comment-dots"></i> Kritik & Saran
                        </a>
                    </li>
                    
                    {{-- Menu Login/User --}}
                    @if(session('user_id'))
                        {{-- User sudah login --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(session('user_avatar'))
                                    <img src="{{ session('user_avatar') }}" alt="" style="width: 24px; height: 24px; border-radius: 50%; margin-right: 5px;">
                                @else
                                    <i class="fas fa-user-circle"></i>
                                @endif
                                {{ session('user_name') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-user"></i> Profil Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('user.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        {{-- User belum login --}}
                        <li class="nav-item">
                            <a class="nav-link btn-login" href="{{ route('user.login') }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                    @endif

                    {{-- Admin Login --}}
                    <li class="nav-item">
                        <a class="nav-link btn-admin-login" href="{{ route('admin.login') }}">
                            <i class="fas fa-lock"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Running Text -->
    <div class="running-text">
        <div class="running-text-content">
            <span style="white-space: nowrap; margin-right: 100px;">
                 Selamat datang di Website Dusun Kemendung • Dsn. Kemendung, Tikung, Lamongan
            </span>
            <span style="white-space: nowrap;">
                 Selamat datang di Website Dusun Kemendung • Dsn. Kemendung, Tikung, Lamongan
            </span>
        </div>
    </div>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-map-marker-alt"></i> Lokasi</h5>
                    <p>{{ config('app.name') }}<br>
                    Dsn. Kemendung, Ds. Jatirejo<br>
                    Kec. Tikung, Kab. Lamongan<br>
                    Jawa Timur</p>
                    
                    <!-- Map Container dengan Custom SVG Icon -->
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15833.819976090748!2d112.41030300000004!3d-7.188810452379681!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77f7eb1226e859%3A0x2e9248c88b377150!2sTikung%2C%20Lamongan%20Regency%2C%20East%20Java%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1770237754082!5m2!1sen!2sus"
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        
                        <!-- Fullscreen Button -->
                        <button class="map-expand-btn" id="openMapModal" title="Perbesar Peta">
                            <img src="{{ asset('fullscreen.svg') }}" alt="Fullscreen" id="expandIcon">
                        </button>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-phone"></i> Kontak</h5>
                    <p>Telpon: {{ config('app.desa_kontak') }}</p>
                    <p>Email: {{ config('app.desa_email') }}</p>
                    <h5 style="margin-top: 20px;"><i class="fas fa-share-alt"></i> Media Sosial</h5>
                    <div style="margin-top: 10px;">
                        <a href="https://facebook.com" target="_blank" class="me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="https://www.instagram.com/kartar_tunasbangsaa?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="https://youtube.com" target="_blank" class="me-3"><i class="fab fa-youtube fa-lg"></i></a>
                        <a href="https://whatsapp.com" target="_blank"><i class="fab fa-whatsapp fa-lg"></i></a>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-file-alt"></i> Tautan Cepat</h5>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('berita') }}">Berita</a></li>
                        <li><a href="{{ route('perangkat') }}">Perangkat Desa</a></li>
                        <li><a href="{{ route('statistik') }}">Statistik</a></li>
                        <li><a href="{{ route('umkm.index') }}">UMKM</a></li>
                        <li><a href="{{ route('kartar.index') }}">Kartar</a></li>
                        <li><a href="{{ route('kritik-saran.index') }}">Kritik & Saran</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 {{ config('app.name') }} - Kec. Tikung, Kab. Lamongan. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Loading Screen
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loader').classList.add('hidden');
            }, 500);
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Map Modal Functionality - Animate from small map to center
        const mapModal = document.getElementById('mapModal');
        const mapModalContent = document.querySelector('.map-modal-content');
        const openMapBtn = document.getElementById('openMapModal');
        const closeMapBtn = document.getElementById('closeMapModal');
        const mapContainer = document.querySelector('.map-container');

        // Get final (center) position
        function getFinalPosition() {
            const vw = window.innerWidth;
            const vh = window.innerHeight;
            const modalWidth = Math.min(vw * 0.9, 1200);
            const modalHeight = vh * 0.85;
            
            return {
                top: (vh - modalHeight) / 2,
                left: (vw - modalWidth) / 2,
                width: modalWidth,
                height: modalHeight
            };
        }

        // Open Modal - Animate from small map position to center
        openMapBtn.addEventListener('click', function() {
            const rect = mapContainer.getBoundingClientRect();
            const final = getFinalPosition();
            
            // Set initial position (same as small map)
            mapModalContent.style.transition = 'none';
            mapModalContent.style.top = rect.top + 'px';
            mapModalContent.style.left = rect.left + 'px';
            mapModalContent.style.width = rect.width + 'px';
            mapModalContent.style.height = rect.height + 'px';
            mapModalContent.style.opacity = '0.5';
            mapModalContent.style.borderRadius = '12px';
            
            // Force reflow
            mapModalContent.offsetHeight;
            
            // Re-enable transition
            mapModalContent.style.transition = '';
            
            // Show modal
            mapModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Animate to center position
            requestAnimationFrame(() => {
                mapModalContent.style.top = final.top + 'px';
                mapModalContent.style.left = final.left + 'px';
                mapModalContent.style.width = final.width + 'px';
                mapModalContent.style.height = final.height + 'px';
                mapModalContent.style.opacity = '1';
                mapModalContent.style.borderRadius = '15px';
            });
        });

        // Close Modal - Animate back to small map position
        function closeModal() {
            const rect = mapContainer.getBoundingClientRect();
            
            // Animate back to small map position
            mapModalContent.style.top = rect.top + 'px';
            mapModalContent.style.left = rect.left + 'px';
            mapModalContent.style.width = rect.width + 'px';
            mapModalContent.style.height = rect.height + 'px';
            mapModalContent.style.opacity = '0';
            mapModalContent.style.borderRadius = '12px';
            
            // Remove active class after animation
            setTimeout(() => {
                mapModal.classList.remove('active');
                document.body.style.overflow = '';
            }, 1000);
        }

        closeMapBtn.addEventListener('click', closeModal);

        // Close when clicking outside
        mapModal.addEventListener('click', function(e) {
            if (e.target === mapModal) {
                closeModal();
            }
        });

        // Close with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mapModal.classList.contains('active')) {
                closeModal();
            }
        });

        // Counter Animation for Stat Numbers
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.textContent = new Intl.NumberFormat('id-ID').format(value);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Intersection Observer for Counter Animation
        const statNumbers = document.querySelectorAll('.stat-number');
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const value = parseInt(element.textContent.replace(/\D/g, '')) || 0;
                    animateValue(element, 0, value, 2000);
                    observer.unobserve(element);
                }
            });
        }, observerOptions);

        statNumbers.forEach(num => observer.observe(num));

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && document.querySelector(href)) {
                    e.preventDefault();
                    document.querySelector(href).scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Parallax Effect for Hero
        window.addEventListener('scroll', function() {
            const hero = document.querySelector('.hero');
            if (hero) {
                const scrolled = window.pageYOffset;
                hero.style.backgroundPositionY = scrolled * 0.5 + 'px';
            }
        });

        // Custom Navbar Toggle
        function toggleNav() {
            const nav = document.getElementById('navbarNav');
            nav.classList.toggle('show');
        }

        // Close nav when clicking a link
        document.querySelectorAll('#navbarNav .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('navbarNav').classList.remove('show');
            });
        });

        // Close nav when clicking outside
        document.addEventListener('click', function(e) {
            const nav = document.getElementById('navbarNav');
            const toggler = document.getElementById('navToggler');
            if (nav.classList.contains('show') && !nav.contains(e.target) && !toggler.contains(e.target)) {
                nav.classList.remove('show');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
