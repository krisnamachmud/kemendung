@extends('layouts.app')

@section('title', 'UMKM')

@section('content')
<!-- UMKM Hero Section -->
<section class="umkm-hero">
    <div class="container text-center">
        <h1 data-aos="fade-down">Usaha Mikro Kecil Menengah Dusun Kemendung</h1>
        <p data-aos="fade-up" data-aos-delay="200">Mendukung pertumbuhan ekonomi lokal melalui UMKM berkualitas</p>
    </div>
</section>

<!-- UMKM Grid Section -->
<section class="umkm-section">
    <div class="container">
        <h2 data-aos="fade-right">Daftar UMKM</h2>
        
        @if($umkms->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-inbox fa-3x mb-3"></i>
                <p>Belum ada UMKM yang terdaftar</p>
            </div>
        @else
            <div class="row">
                @forelse ($umkms as $index => $umkm)
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 + 100 }}">
                        <div class="umkm-card">
                            @if ($umkm->logo)
                                <div class="umkm-logo">
                                    <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->nama }}" class="img-fluid">
                                </div>
                            @else
                                <div class="umkm-logo-placeholder">
                                    <i class="fas fa-building fa-3x"></i>
                                </div>
                            @endif
                            
                            <div class="umkm-card-body">
                                <h5 class="umkm-title">{{ $umkm->nama }}</h5>
                                <p class="umkm-category">
                                    <i class="fas fa-tag"></i> {{ $umkm->kategori }}
                                </p>
                                <p class="umkm-description">{{ Str::limit($umkm->deskripsi, 80) }}</p>
                                
                                @if($umkm->kontak)
                                    <p class="umkm-info">
                                        <i class="fas fa-phone"></i> {{ $umkm->kontak }}
                                    </p>
                                @endif
                                
                                <a href="{{ route('umkm.show', $umkm->slug) }}" class="btn btn-umkm">
                                    Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        @endif
    </div>
</section>

<style>
    .umkm-hero {
        background: linear-gradient(rgba(26, 95, 74, 0.7), rgba(45, 125, 99, 0.7)),
                    url('https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200') center/cover;
        color: white;
        padding: 80px 0;
        text-align: center;
        min-height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .umkm-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .umkm-hero p {
        font-size: 1.1rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    .umkm-section {
        padding: 60px 0;
        background: #f8f9fa;
    }

    .umkm-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .umkm-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .umkm-logo {
        width: 100%;
        height: 200px;
        background: #e8f4f8;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .umkm-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .umkm-logo-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .umkm-card-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .umkm-title {
        color: #1a5f4a;
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .umkm-category {
        color: #3498db;
        font-size: 0.9rem;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .umkm-description {
        color: #7f8c8d;
        font-size: 0.95rem;
        margin-bottom: 15px;
        flex-grow: 1;
    }

    .umkm-info {
        color: #34495e;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .btn-umkm {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        align-self: flex-start;
        margin-top: auto;
        font-weight: 600;
    }

    .btn-umkm:hover {
        background: linear-gradient(135deg, #2980b9 0%, #1a5f7a 100%);
        color: white;
        transform: translateX(5px);
    }

    @media (max-width: 768px) {
        .umkm-hero h1 {
            font-size: 1.8rem;
        }

        .umkm-logo {
            height: 150px;
        }
    }
</style>
@endsection
