@extends('layouts.app')

@section('title', $umkm->nama)

@section('content')
<!-- UMKM Detail Section -->
<section class="umkm-detail-section">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('umkm.index') }}">UMKM</a></li>
                <li class="breadcrumb-item active">{{ $umkm->nama }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-5 mb-4" data-aos="fade-right">
                <div class="umkm-detail-image img-glow">
                    @if ($umkm->logo)
                        <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->nama }}" class="img-fluid img-hover-zoom img-lightbox-trigger" loading="lazy">
                    @else
                        <div class="umkm-image-placeholder">
                            <i class="fas fa-building fa-5x"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-7" data-aos="fade-left">
                <div class="umkm-detail-content">
                    <h1 class="umkm-detail-title">{{ $umkm->nama }}</h1>
                    
                    <p class="umkm-detail-category">
                        <i class="fas fa-tag"></i> <strong>Kategori:</strong> {{ $umkm->kategori }}
                    </p>

                    @if($umkm->pemilik)
                        <p class="umkm-detail-info">
                            <i class="fas fa-user"></i> <strong>Pemilik:</strong> {{ $umkm->pemilik }}
                        </p>
                    @endif

                    @if($umkm->kontak)
                        <p class="umkm-detail-info">
                            <i class="fas fa-phone"></i> <strong>Kontak:</strong> 
                            <a href="tel:{{ $umkm->kontak }}">{{ $umkm->kontak }}</a>
                        </p>
                    @endif

                    @if($umkm->email)
                        <p class="umkm-detail-info">
                            <i class="fas fa-envelope"></i> <strong>Email:</strong> 
                            <a href="mailto:{{ $umkm->email }}">{{ $umkm->email }}</a>
                        </p>
                    @endif

                    @if($umkm->jam_operasional)
                        <p class="umkm-detail-info">
                            <i class="fas fa-clock"></i> <strong>Jam Operasional:</strong> {{ $umkm->jam_operasional }}
                        </p>
                    @endif

                    @if($umkm->alamat)
                        <p class="umkm-detail-info">
                            <i class="fas fa-map-marker-alt"></i> <strong>Alamat:</strong> {{ $umkm->alamat }}
                        </p>
                    @endif

                    @if($umkm->deskripsi)
                        <div class="umkm-detail-description">
                            <h5>Deskripsi</h5>
                            <p>{{ $umkm->deskripsi }}</p>
                        </div>
                    @endif

                    @if($umkm->catatan)
                        <div class="umkm-detail-note">
                            <h5>Catatan</h5>
                            <p>{{ $umkm->catatan }}</p>
                        </div>
                    @endif

                    <div class="umkm-detail-actions">
                        <a href="{{ route('umkm.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke UMKM
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Maps -->
        @if($umkm->latitude && $umkm->longitude)
            <div class="row mt-5">
                <div class="col-12">
                    <div class="umkm-map-container" data-aos="zoom-in">
                        <h3 class="mb-4">Lokasi di Peta</h3>
                        <div id="umkmMap" style="width: 100%; height: 400px; border-radius: 10px; overflow: hidden;"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Related UMKM Section -->
@if($otherUmkms->count() > 0)
    <section class="related-umkm-section">
        <div class="container">
            <h2 data-aos="fade-right">UMKM Lainnya</h2>
            <div class="row">
                @foreach($otherUmkms as $index => $other)
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="umkm-card img-glow">
                            @if ($other->logo)
                                <div class="umkm-logo img-animate-container">
                                    <img src="{{ asset('storage/' . $other->logo) }}" alt="{{ $other->nama }}" class="img-fluid img-hover-zoom img-lightbox-trigger" loading="lazy">
                                </div>
                            @else
                                <div class="umkm-logo-placeholder">
                                    <i class="fas fa-building fa-3x"></i>
                                </div>
                            @endif
                            
                            <div class="umkm-card-body">
                                <h5 class="umkm-title">{{ $other->nama }}</h5>
                                <p class="umkm-category">
                                    <i class="fas fa-tag"></i> {{ $other->kategori }}
                                </p>
                                <p class="umkm-description">{{ Str::limit($other->deskripsi, 80) }}</p>
                                
                                <a href="{{ route('umkm.show', $other->slug) }}" class="btn btn-umkm">
                                    Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<style>
    .umkm-detail-section {
        padding: 60px 0;
        background: white;
    }

    .breadcrumb {
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 5px;
    }

    .umkm-detail-image {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .umkm-detail-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .umkm-image-placeholder {
        width: 100%;
        height: 350px;
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .umkm-detail-content {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
    }

    .umkm-detail-title {
        color: #1a5f4a;
        font-weight: 700;
        margin-bottom: 20px;
        font-size: 2rem;
    }

    .umkm-detail-category {
        color: #3498db;
        font-size: 1rem;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .umkm-detail-info {
        color: #34495e;
        font-size: 0.95rem;
        margin-bottom: 12px;
        line-height: 1.6;
    }

    .umkm-detail-info a {
        color: #3498db;
        text-decoration: none;
    }

    .umkm-detail-info a:hover {
        text-decoration: underline;
    }

    .umkm-detail-description,
    .umkm-detail-note {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #ddd;
    }

    .umkm-detail-description h5,
    .umkm-detail-note h5 {
        color: #1a5f4a;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .umkm-detail-description p,
    .umkm-detail-note p {
        color: #555;
        line-height: 1.8;
        text-align: justify;
    }

    .umkm-detail-actions {
        margin-top: 30px;
    }

    .umkm-detail-actions .btn {
        padding: 10px 25px;
        font-weight: 600;
    }

    .umkm-map-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    }

    .umkm-map-container h3 {
        color: #1a5f4a;
        font-weight: 700;
    }

    .related-umkm-section {
        padding: 60px 0;
        background: #f8f9fa;
    }

    @media (max-width: 768px) {
        .umkm-detail-title {
            font-size: 1.5rem;
        }

        .umkm-detail-content {
            margin-top: 30px;
        }

        .umkm-image-placeholder {
            height: 250px;
        }
    }
</style>

@if($umkm->latitude && $umkm->longitude)
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY', '') }}&language=id"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mapElement = document.getElementById('umkmMap');
        if (mapElement) {
            const map = new google.maps.Map(mapElement, {
                zoom: 16,
                center: {
                    lat: {{ $umkm->latitude }},
                    lng: {{ $umkm->longitude }}
                },
                mapTypeId: 'roadmap'
            });

            // Add marker
            const marker = new google.maps.Marker({
                position: {
                    lat: {{ $umkm->latitude }},
                    lng: {{ $umkm->longitude }}
                },
                map: map,
                title: '{{ $umkm->nama }}'
            });

            // Add info window
            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div style="font-family: Arial; width: 250px;">
                        <h5 style="color: #1a5f4a; margin-bottom: 8px;">{{ $umkm->nama }}</h5>
                        <p style="margin: 5px 0; color: #666;">{{ $umkm->alamat }}</p>
                        @if($umkm->kontak)
                            <p style="margin: 5px 0; color: #666;">
                                <i class="fas fa-phone"></i> <a href="tel:{{ $umkm->kontak }}">{{ $umkm->kontak }}</a>
                            </p>
                        @endif
                    </div>
                `,
                maxWidth: 250
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });
        }
    });
</script>
@endif
@endsection
