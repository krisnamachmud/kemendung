@extends('layouts.app')

@section('title', 'Perangkat Desa')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #1a5f4a 0%, #2d7d63 100%); color: white; padding: 60px 0; margin-bottom: 40px;">
    <div class="container">
        <h1 data-aos="fade-right">Perangkat & Organisasi</h1>
        <p data-aos="fade-right" data-aos-delay="200">Struktur Organisasi Desa dan Karang Taruna Dusun Kemendung</p>
    </div>
</section>

<div class="container mb-5">
    <!-- Tab Switch -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="tab-switch-container" data-aos="fade-up">
                <div class="tab-switch">
                    <button class="tab-btn active" data-tab="perangkat-desa">
                        <i class="fas fa-landmark"></i> Perangkat Desa
                    </button>
                    <button class="tab-btn" data-tab="karang-taruna">
                        <i class="fas fa-users"></i> Karang Taruna
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Content: Perangkat Desa -->
    <div id="perangkat-desa" class="tab-content active">
        <!-- Kepala Desa dan Sekretaris -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 style="color: #1a5f4a; text-align: center; margin-bottom: 50px;" data-aos="fade-up">
                    <i class="fas fa-crown"></i> Pimpinan Desa
                </h2>
            </div>

            @php
                $kepala = $perangkat->where('jabatan', 'Kepala Desa')->first();
                $sekretaris = $perangkat->where('jabatan', 'Sekretaris Desa')->first();
            @endphp

            @if ($kepala)
                <div class="col-md-6 mb-4" data-aos="flip-left" data-aos-delay="100">
                    <div class="card text-center img-glow card-tilt" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        @if ($kepala->foto)
                            <div class="img-animate-container img-overlay-container" style="height: 300px;">
                                <img src="{{ asset('storage/' . $kepala->foto) }}" class="card-img-top img-hover-zoom img-lightbox-trigger" alt="{{ $kepala->nama }}" style="height: 300px; object-fit: cover;" loading="lazy">
                            </div>
                        @else
                            <div class="bg-secondary" style="height: 300px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user fa-5x" style="color: white;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="color: #1a5f4a;">{{ $kepala->nama }}</h5>
                            <p class="card-text" style="color: #f39c12; font-weight: 600; font-size: 1.1rem;">
                                {{ $kepala->jabatan }}
                            </p>
                            @if ($kepala->nip)
                                <p class="text-muted">
                                    <strong>NIP:</strong> {{ $kepala->nip }}
                                </p>
                            @endif
                            @if ($kepala->no_ktp)
                                <p class="text-muted">
                                    <strong>No. KTP:</strong> {{ $kepala->no_ktp }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if ($sekretaris)
                <div class="col-md-6 mb-4" data-aos="flip-right" data-aos-delay="200">
                    <div class="card text-center img-glow card-tilt" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        @if ($sekretaris->foto)
                            <div class="img-animate-container img-overlay-container" style="height: 300px;">
                                <img src="{{ asset('storage/' . $sekretaris->foto) }}" class="card-img-top img-hover-zoom img-lightbox-trigger" alt="{{ $sekretaris->nama }}" style="height: 300px; object-fit: cover;" loading="lazy">
                            </div>
                        @else
                            <div class="bg-secondary" style="height: 300px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user fa-5x" style="color: white;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="color: #1a5f4a;">{{ $sekretaris->nama }}</h5>
                            <p class="card-text" style="color: #f39c12; font-weight: 600; font-size: 1.1rem;">
                                {{ $sekretaris->jabatan }}
                            </p>
                            @if ($sekretaris->nip)
                                <p class="text-muted">
                                    <strong>NIP:</strong> {{ $sekretaris->nip }}
                                </p>
                            @endif
                            @if ($sekretaris->no_ktp)
                                <p class="text-muted">
                                    <strong>No. KTP:</strong> {{ $sekretaris->no_ktp }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <hr style="margin: 60px 0;">

        <!-- Kepala Dusun Kemendung -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 style="color: #1a5f4a; text-align: center; margin-bottom: 50px;" data-aos="fade-up">
                    <i class="fas fa-users"></i> Kepala Dusun Kemendung
                </h2>
            </div>

            @php
                $kasun = $perangkat->where('dusun', 'Kemendung')->where('jabatan', 'Kepala Dusun')->first();
            @endphp

            @if ($kasun)
                <div class="col-md-6 mx-auto mb-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card text-center img-glow card-tilt" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        @if ($kasun->foto)
                            <div class="img-animate-container img-overlay-container" style="height: 300px;">
                                <img src="{{ asset('storage/' . $kasun->foto) }}" class="card-img-top img-hover-zoom img-lightbox-trigger" alt="{{ $kasun->nama }}" style="height: 300px; object-fit: cover;" loading="lazy">
                            </div>
                        @else
                            <div class="bg-secondary" style="height: 300px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user fa-5x" style="color: white;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="color: #1a5f4a;">{{ $kasun->nama }}</h5>
                            <p class="card-text" style="color: #f39c12; font-weight: 600; font-size: 1.1rem;">
                                {{ $kasun->jabatan }} Dusun Kemendung
                            </p>
                            @if ($kasun->nip)
                                <p class="text-muted">
                                    <strong>NIP:</strong> {{ $kasun->nip }}
                                </p>
                            @endif
                            @if ($kasun->no_ktp)
                                <p class="text-muted">
                                    <strong>No. KTP:</strong> {{ $kasun->no_ktp }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <hr style="margin: 60px 0;">

        <!-- Perangkat Lainnya -->
        <div class="row">
            <div class="col-12">
                <h2 style="color: #1a5f4a; text-align: center; margin-bottom: 50px;" data-aos="fade-up">
                    <i class="fas fa-briefcase"></i> Struktur Aparatur Desa
                </h2>
            </div>

            @php
                $aparatur = $perangkat->whereNotIn('jabatan', ['Kepala Desa', 'Sekretaris Desa', 'Kepala Dusun']);
            @endphp

            @forelse ($aparatur as $index => $item)
                <div class="col-md-4 mb-4" data-aos="flip-up" data-aos-delay="{{ ($index % 3) * 100 + 100 }}">
                    <div class="card text-center img-glow" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                        @if ($item->foto)
                            <div class="img-animate-container img-overlay-container" style="height: 200px;">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top img-hover-zoom img-lightbox-trigger" alt="{{ $item->nama }}" style="height: 200px; object-fit: cover;" loading="lazy">
                            </div>
                        @else
                            <div class="bg-secondary" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user fa-3x" style="color: white;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="color: #1a5f4a;">{{ $item->nama }}</h5>
                            <p class="card-text" style="color: #f39c12; font-weight: 600;">
                                {{ $item->jabatan }}
                            </p>
                            @if ($item->dusun)
                                <small class="text-muted d-block">
                                    <i class="fas fa-map-pin"></i> {{ $item->dusun }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12" data-aos="fade-up">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Tidak ada aparatur lain yang didaftar
                    </div>
                </div>
            @endforelse
        </div>

        @if ($perangkat->count() == 0)
            <div class="alert alert-warning text-center" data-aos="fade-up">
                <i class="fas fa-exclamation-triangle"></i> Belum ada data perangkat desa
            </div>
        @endif
    </div>

    <!-- Tab Content: Karang Taruna -->
    <div id="karang-taruna" class="tab-content" style="display: none;">
        <!-- Pengurus Inti -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 style="color: #3498db; text-align: center; margin-bottom: 50px;" data-aos="fade-up">
                    <i class="fas fa-user-tie"></i> Pengurus Inti Karang Taruna
                </h2>
            </div>

            @php
                $pengurusInti = $kartar->whereIn('jabatan', ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara']);
            @endphp

            @forelse ($pengurusInti as $index => $anggota)
                <div class="col-md-3 col-6 mb-4" data-aos="flip-left" data-aos-delay="{{ $index * 100 }}">
                    <div class="card text-center kartar-card img-glow" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-top: 4px solid #3498db;">
                        @if ($anggota->foto)
                            <div class="img-animate-container" style="height: 200px;">
                                <img src="{{ asset('storage/' . $anggota->foto) }}" class="card-img-top img-hover-zoom img-lightbox-trigger" alt="{{ $anggota->nama }}" style="height: 200px; object-fit: cover;" loading="lazy">
                            </div>
                        @else
                            <div style="height: 200px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);">
                                <i class="fas fa-user fa-4x" style="color: white;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h6 class="card-title mb-1" style="color: #2c3e50; font-weight: 600;">{{ $anggota->nama }}</h6>
                            <span class="badge bg-primary mb-2">{{ $anggota->jabatan }}</span>
                            @if ($anggota->no_hp)
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-phone"></i> {{ $anggota->no_hp }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Belum ada pengurus inti yang didaftarkan
                    </div>
                </div>
            @endforelse
        </div>

        <hr style="margin: 60px 0;">

        <!-- Anggota Lainnya -->
        <div class="row">
            <div class="col-12">
                <h2 style="color: #3498db; text-align: center; margin-bottom: 50px;" data-aos="fade-up">
                    <i class="fas fa-users"></i> Anggota Karang Taruna
                </h2>
            </div>

            @php
                $anggotaLain = $kartar->whereNotIn('jabatan', ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara']);
            @endphp

            @forelse ($anggotaLain as $index => $anggota)
                <div class="col-md-3 col-6 mb-4" data-aos="zoom-in" data-aos-delay="{{ ($index % 4) * 50 }}">
                    <div class="card text-center kartar-card img-glow" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                        @if ($anggota->foto)
                            <div class="img-animate-container" style="height: 180px;">
                                <img src="{{ asset('storage/' . $anggota->foto) }}" class="card-img-top img-hover-zoom img-lightbox-trigger" alt="{{ $anggota->nama }}" style="height: 180px; object-fit: cover;" loading="lazy">
                            </div>
                        @else
                            <div style="height: 180px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #85c1e2 0%, #3498db 100%);">
                                <i class="fas fa-user fa-3x" style="color: white;"></i>
                            </div>
                        @endif
                        <div class="card-body py-3">
                            <h6 class="card-title mb-1" style="color: #2c3e50; font-size: 0.95rem;">{{ $anggota->nama }}</h6>
                            @if ($anggota->jabatan && $anggota->jabatan != 'Anggota')
                                <span class="badge bg-secondary small">{{ $anggota->jabatan }}</span>
                            @else
                                <span class="badge bg-light text-dark small">Anggota</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Belum ada anggota yang didaftarkan
                    </div>
                </div>
            @endforelse
        </div>

        @if (!isset($kartar) || $kartar->count() == 0)
            <div class="alert alert-warning text-center" data-aos="fade-up">
                <i class="fas fa-exclamation-triangle"></i> Belum ada data anggota Karang Taruna
            </div>
        @endif

        <!-- Info Karang Taruna -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card" style="border: none; background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white;" data-aos="fade-up">
                    <div class="card-body text-center py-4">
                        <h4><i class="fas fa-info-circle"></i> Tentang Karang Taruna</h4>
                        <p class="mb-0">Karang Taruna Dusun Kemendung adalah organisasi kepemudaan yang bergerak dalam bidang kesejahteraan sosial dan pembangunan masyarakat.</p>
                        <a href="{{ route('kartar.index') }}" class="btn btn-light mt-3">
                            <i class="fas fa-arrow-right"></i> Lihat Kegiatan Karang Taruna
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Tab Switch Styles */
    .tab-switch-container {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }

    .tab-switch {
        display: inline-flex;
        background: #f0f0f0;
        border-radius: 50px;
        padding: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .tab-btn {
        padding: 12px 30px;
        border: none;
        background: transparent;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        color: #666;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .tab-btn:hover {
        color: #333;
    }

    .tab-btn.active {
        background: linear-gradient(135deg, #1a5f4a 0%, #2d7d63 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(26, 95, 74, 0.4);
    }

    .tab-btn[data-tab="karang-taruna"].active {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
    }

    .tab-content {
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .kartar-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .kartar-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .tab-btn {
            padding: 10px 20px;
            font-size: 0.9rem;
        }

        .tab-btn i {
            display: none;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Remove active class from all buttons
            tabBtns.forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');

            // Hide all tab contents
            tabContents.forEach(content => {
                content.style.display = 'none';
            });

            // Show target tab content
            document.getElementById(targetTab).style.display = 'block';

            // Re-trigger AOS animations
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        });
    });
});
</script>
@endsection
