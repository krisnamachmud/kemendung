@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #1a5f4a 0%, #2d7d63 100%); color: white; padding: 60px 0; margin-bottom: 40px;">
    <div class="container">
        <h1>{{ $berita->judul }}</h1>
        <small>
            <i class="fas fa-calendar"></i> {{ $berita->created_at->format('d M Y') }} |
            <i class="fas fa-user"></i> {{ $berita->penulis }} |
            <i class="fas fa-tag"></i> {{ $berita->kategori }}
        </small>
    </div>
</section>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-8">
            <!-- Konten Berita -->
            <article class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                @if ($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="max-height: 400px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <div class="mb-4 pb-4" style="border-bottom: 2px solid #eee;">
                        <span class="badge bg-primary">{{ $berita->kategori }}</span>
                    </div>

                    @if ($berita->deskripsi)
                        <div class="alert alert-light border" style="border-left: 4px solid #f39c12 !important;">
                            <strong>Ringkasan:</strong> {{ $berita->deskripsi }}
                        </div>
                    @endif

                    <div class="article-content" style="line-height: 1.8; font-size: 1.05rem;">
                        {!! nl2br(e($berita->konten)) !!}
                    </div>

                    <div class="mt-5 pt-4" style="border-top: 2px solid #eee;">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <strong>Dipublikasikan:</strong> {{ $berita->created_at->format('d M Y H:i') }}
                                </small>
                                @if ($berita->updated_at != $berita->created_at)
                                    <br>
                                    <small class="text-muted">
                                        <strong>Diperbarui:</strong> {{ $berita->updated_at->format('d M Y H:i') }}
                                    </small>
                                @endif
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('berita') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Berita
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Share Section -->
            <div class="card mt-4" style="border: none; background: #f8f9fa;">
                <div class="card-body text-center">
                    <h6 class="mb-3">Bagikan Berita Ini</h6>
                    <div>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-sm btn-primary me-2">
                            <i class="fab fa-facebook"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $berita->judul }}" target="_blank" class="btn btn-sm btn-info me-2">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ $berita->judul }} {{ url()->current() }}" target="_blank" class="btn btn-sm btn-success me-2">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <button onclick="copyLink()" class="btn btn-sm btn-secondary">
                            <i class="fas fa-link"></i> Salin Link
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Berita Terkait -->
            @if ($beritaTerkait->count() > 0)
                <div class="card mb-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-link"></i> Berita Terkait</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($beritaTerkait as $item)
                            <div class="mb-4 pb-3" style="border-bottom: 1px solid #eee;">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid mb-2 rounded" alt="{{ $item->judul }}" style="height: 120px; width: 100%; object-fit: cover;">
                                @endif
                                <h6 style="color: #1a5f4a;">
                                    <a href="{{ route('berita.detail', $item->slug) }}" class="text-decoration-none">
                                        {{ Str::limit($item->judul, 60) }}
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i> {{ $item->created_at->format('d M Y') }}
                                </small>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Info Box -->
            <div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Kategori:</strong><br>
                        <span class="badge bg-primary">{{ $berita->kategori }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Penulis:</strong><br>
                        {{ $berita->penulis }}
                    </div>
                    <div>
                        <strong>Tanggal Publikasi:</strong><br>
                        {{ $berita->created_at->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyLink() {
        const url = '{{ url()->current() }}';
        navigator.clipboard.writeText(url).then(() => {
            alert('Link telah disalin ke clipboard!');
        });
    }
</script>
@endsection
