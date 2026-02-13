@extends('layouts.app')

@section('title', 'Berita & Artikel')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #1a5f4a 0%, #2d7d63 100%); color: white; padding: 60px 0; margin-bottom: 40px;">
    <div class="container">
        <h1 data-aos="fade-right">Berita & Artikel</h1>
        <p data-aos="fade-right" data-aos-delay="200">Informasi terkini dari Dusun Kemendung</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-8">
            <!-- Daftar Berita -->
            @forelse ($berita as $index => $item)
                <div class="card mb-4" style="border: none; border-bottom: 1px solid #eee; border-radius: 0;" data-aos="fade-up" data-aos-delay="{{ ($index % 5) * 100 }}">
                    <div class="row g-0">
                        @if ($item->gambar)
                            <div class="col-md-4" style="overflow: hidden;">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid rounded" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover; width: 100%; transition: transform 0.5s ease;">
                            </div>
                        @endif
                        <div class="col-md-{{ $item->gambar ? 8 : 12 }}">
                            <div class="card-body">
                                <span class="badge bg-primary mb-2">{{ $item->kategori }}</span>
                                <h5 class="card-title" style="color: #1a5f4a;">{{ $item->judul }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($item->deskripsi ?? $item->konten, 150) }}</p>
                                <small class="text-muted d-block mb-3">
                                    <i class="fas fa-user"></i> {{ $item->penulis }} | 
                                    <i class="fas fa-calendar"></i> {{ $item->created_at->format('d M Y') }}
                                </small>
                                <a href="{{ route('berita.detail', $item->slug) }}" class="text-decoration-none" style="color: #f39c12; font-weight: 600;">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center" data-aos="fade-up">
                    <i class="fas fa-info-circle"></i> Belum ada berita yang dipublikasikan
                </div>
            @endforelse

            <!-- Pagination -->
            <nav aria-label="Pagination" class="mt-4" data-aos="fade-up">
                {{ $berita->links('pagination::bootstrap-5') }}
            </nav>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Kategori -->
            <div class="card mb-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);" data-aos="fade-left" data-aos-delay="100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter"></i> Kategori</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-newspaper"></i> Umum
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-heart"></i> PKK
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-users"></i> Karang Taruna
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-comments"></i> Musrenbangdes
                    </a>
                </div>
            </div>

            <!-- Berita Populer -->
            <div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);" data-aos="fade-left" data-aos-delay="200">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-fire"></i> Berita Populer</h5>
                </div>
                <div class="card-body">
                    @php
                        $populerBerita = \App\Models\Berita::where('dipublikasikan', true)
                                        ->latest()
                                        ->take(5)
                                        ->get();
                    @endphp
                    @forelse ($populerBerita as $item)
                        <div class="mb-3 pb-3" style="border-bottom: 1px solid #eee;">
                            <h6 style="color: #1a5f4a;">
                                <a href="{{ route('berita.detail', $item->slug) }}" class="text-decoration-none">
                                    {{ Str::limit($item->judul, 50) }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i> {{ $item->created_at->format('d M Y') }}
                            </small>
                        </div>
                    @empty
                        <p class="text-muted text-center">Belum ada berita</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
