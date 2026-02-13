@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container text-center">
        <h1 data-aos="fade-down">Selamat Datang di Dusun Kemendung</h1>
        <p data-aos="fade-up" data-aos-delay="200">Dsn. Kemendung, Kec. Tikung, Kab. Lamongan, Jawa Timur</p>
        <a href="#statistik" class="btn-primary-custom" data-aos="zoom-in" data-aos-delay="400">
            <i class="fas fa-arrow-down"></i> Jelajahi
        </a>
        <div class="scroll-indicator" data-aos="fade-up" data-aos-delay="600">
            <i class="fas fa-chevron-down fa-2x text-white"></i>
        </div>
    </div>
</section>

<!-- Statistik Desa -->
<section id="statistik" class="bg-light">
    <div class="container">
        <h2 data-aos="fade-right">Statistik Desa</h2>
        <div class="row">
            @if ($statistik)
                <div class="col-md-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-box">
                        <i class="fas fa-male" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <div class="stat-label">Penduduk Laki-laki</div>
                        <div class="stat-number">{{ $statistik->penduduk_laki ?? 0 }}</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-box">
                        <i class="fas fa-female" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <div class="stat-label">Penduduk Perempuan</div>
                        <div class="stat-number">{{ $statistik->penduduk_perempuan ?? 0 }}</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-box">
                        <i class="fas fa-home" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <div class="stat-label">Kepala Keluarga</div>
                        <div class="stat-number">{{ $statistik->kepala_keluarga ?? 0 }}</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-box">
                        <i class="fas fa-map" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <div class="stat-label">Luas Wilayah (Ha)</div>
                        <div class="stat-number">{{ $statistik->luas_wilayah ?? 0 }}</div>
                    </div>
                </div>
            @else
                <div class="col-12 text-center text-muted">
                    <p>Data statistik belum tersedia</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Berita Terbaru -->
<section>
    <div class="container">
        <h2 data-aos="fade-right">Berita & Informasi Terkini</h2>
        <div class="row">
            @forelse ($berita as $index => $item)
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 + 100 }}">
                    <div class="card h-100">
                        @if ($item->gambar)
                            <div style="overflow: hidden;">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                            </div>
                        @else
                            <div class="bg-secondary" style="height: 200px; display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="fas fa-newspaper fa-3x"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">{{ $item->kategori }}</span>
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($item->deskripsi ?? $item->konten, 100) }}</p>
                            <small class="text-muted">
                                <i class="fas fa-user"></i> {{ $item->penulis }} | 
                                <i class="fas fa-calendar"></i> {{ $item->created_at->format('d M Y') }}
                            </small>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('berita.detail', $item->slug) }}" class="text-decoration-none" style="color: var(--primary-color);">
                                Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Belum ada berita yang dipublikasikan</p>
                </div>
            @endforelse
        </div>

        @if ($berita->count() > 0)
            <div class="text-center mt-4" data-aos="zoom-in">
                <a href="{{ route('berita') }}" class="btn-primary-custom">
                    Lihat Semua Berita <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Perangkat Desa -->
<section class="bg-light">
    <div class="container">
        <h2 data-aos="fade-right">Perangkat Desa</h2>
        <div class="row">
            @forelse ($perangkat as $index => $item)
                <div class="col-md-4 col-sm-6 mb-4" data-aos="flip-left" data-aos-delay="{{ ($index % 3) * 150 + 100 }}">
                    <div class="card text-center h-100">
                        @if ($item->foto)
                            <div style="overflow: hidden;">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" alt="{{ $item->nama }}" style="height: 250px; object-fit: cover;">
                            </div>
                        @else
                            <div class="bg-secondary" style="height: 250px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user fa-5x" style="color: white;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                            <p class="card-text text-muted">{{ $item->jabatan }}</p>
                            @if ($item->dusun)
                                <small class="text-muted d-block">
                                    <i class="fas fa-map-pin"></i> {{ $item->dusun }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Belum ada data perangkat desa</p>
                </div>
            @endforelse
        </div>

        @if ($perangkat->count() > 0)
            <div class="text-center mt-4" data-aos="zoom-in">
                <a href="{{ route('perangkat') }}" class="btn-primary-custom">
                    Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Transparansi APBDes -->
<section>
    <div class="container">
        <h2 data-aos="fade-right">Transparansi Anggaran (APBDes)</h2>
        <div class="row">
            <div class="col-md-6 mb-4" data-aos="fade-right" data-aos-delay="100">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Pendapatan</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-left" data-aos-delay="200">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Pengeluaran</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="expenditureChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Chart Pendapatan
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'doughnut',
        data: {
            labels: ['Dana Desa', 'Pajak', 'Retribusi', 'Lainnya'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: [
                    '#1a5f4a',
                    '#2d7d63',
                    '#f39c12',
                    '#e74c3c'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Chart Pengeluaran
    const expenditureCtx = document.getElementById('expenditureChart').getContext('2d');
    new Chart(expenditureCtx, {
        type: 'bar',
        data: {
            labels: ['Pendidikan', 'Infrastruktur', 'Kesehatan', 'Administrasi', 'Sosial'],
            datasets: [{
                label: 'Alokasi (Jutaan Rp)',
                data: [250, 320, 180, 150, 100],
                backgroundColor: '#e74c3c'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
