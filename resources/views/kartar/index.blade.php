@extends('layouts.app')

@section('title', 'Karang Taruna - Tunas Bangsa')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #1a5f4a 0%, #2d7d63 100%); color: white; padding: 60px 0; margin-bottom: 40px;">
    <div class="container">
        <h1 data-aos="fade-right"><i class="fas fa-users-gear"></i> Karang Taruna Tunas Bangsa</h1>
        <p data-aos="fade-right" data-aos-delay="200">Organisasi Kepemudaan Dusun Kemendung</p>
    </div>
</section>

<div class="container mb-5">

    <!-- Profil Section -->
    <section class="mb-5" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 style="color: #1a5f4a; margin-bottom: 20px;">
                    <i class="fas fa-info-circle"></i> Profil Karang Taruna
                </h2>
                <div class="card" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 15px;">
                    <div class="card-body p-4">
                        <div style="text-align: center; margin-bottom: 20px;">
                            <img src="{{ asset('images/image.png') }}" alt="Logo Karang Taruna Tunas Bangsa"
                                style="max-height: 200px; border-radius: 10px; object-fit: cover; width: 100%;">
                        </div>
                        <p style="font-size: 1.1rem; line-height: 1.8; color: #555;">
                            <strong>Karang Taruna Tunas Bangsa</strong> adalah organisasi kepemudaan yang bergerak di
                            bidang pemberdayaan masyarakat, khususnya generasi muda di Dusun Kemendung, Kecamatan Tikung,
                            Kabupaten Lamongan. Organisasi ini berperan aktif dalam berbagai kegiatan sosial, budaya,
                            dan pembangunan desa.
                        </p>
                        <div class="row mt-4">
                            <div class="col-md-4 mb-3">
                                <div style="text-align: center; padding: 15px; background: linear-gradient(135deg, #1a5f4a, #2d7d63); border-radius: 10px; color: white;">
                                    <i class="fas fa-bullseye fa-2x mb-2"></i>
                                    <h6>Visi</h6>
                                    <small>Mewujudkan pemuda yang kreatif, inovatif, dan berdaya saing</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div style="text-align: center; padding: 15px; background: linear-gradient(135deg, #f39c12, #e67e22); border-radius: 10px; color: white;">
                                    <i class="fas fa-handshake fa-2x mb-2"></i>
                                    <h6>Misi</h6>
                                    <small>Membangun solidaritas dan gotong royong antar pemuda dusun</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div style="text-align: center; padding: 15px; background: linear-gradient(135deg, #e74c3c, #c0392b); border-radius: 10px; color: white;">
                                    <i class="fas fa-heart fa-2x mb-2"></i>
                                    <h6>Nilai</h6>
                                    <small>Kebersamaan, integritas, dan pengabdian kepada masyarakat</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Anggota Section -->
    <section class="mb-5" data-aos="fade-up">
        <h2 style="color: #1a5f4a; text-align: center; margin-bottom: 30px;">
            <i class="fas fa-id-card"></i> Struktur Organisasi
        </h2>

        @if($anggota->count() > 0)
            {{-- Ketua --}}
            @php $ketua = $anggota->where('jabatan', 'Ketua')->first(); @endphp
            @if($ketua)
            <div class="row justify-content-center mb-4">
                <div class="col-md-4" data-aos="flip-left">
                    <div class="card text-center" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 15px; overflow: hidden;">
                        @if($ketua->foto)
                            <div style="overflow: hidden;">
                                <img src="{{ asset('storage/' . $ketua->foto) }}" class="card-img-top" alt="{{ $ketua->nama }}" style="height: 280px; object-fit: cover;">
                            </div>
                        @else
                            <div style="height: 280px; background: linear-gradient(135deg, #1a5f4a, #2d7d63); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user fa-5x" style="color: rgba(255,255,255,0.5);"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 style="color: #1a5f4a; font-weight: 700;">{{ $ketua->nama }}</h5>
                            <span class="badge" style="background: linear-gradient(135deg, #f39c12, #e67e22); font-size: 0.9rem; padding: 6px 15px;">
                                {{ $ketua->jabatan }}
                            </span>
                            @if($ketua->no_hp)
                                <p class="mt-2 mb-0"><small class="text-muted"><i class="fas fa-phone"></i> {{ $ketua->no_hp }}</small></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Anggota lain --}}
            @php $lainnya = $anggota->where('jabatan', '!=', 'Ketua'); @endphp
            @if($lainnya->count() > 0)
            <div class="row">
                @foreach($lainnya as $member)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card text-center h-100" style="border: none; box-shadow: 0 3px 10px rgba(0,0,0,0.08); border-radius: 15px; overflow: hidden; transition: transform 0.3s;">
                        @if($member->foto)
                            <div style="overflow: hidden;">
                                <img src="{{ asset('storage/' . $member->foto) }}" class="card-img-top" alt="{{ $member->nama }}" style="height: 200px; object-fit: cover;">
                            </div>
                        @else
                            <div style="height: 200px; background: linear-gradient(135deg, #2d7d63, #3d9d83); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user fa-3x" style="color: rgba(255,255,255,0.5);"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h6 style="color: #1a5f4a; font-weight: 600;">{{ $member->nama }}</h6>
                            <span class="badge bg-success" style="font-size: 0.8rem;">{{ $member->jabatan }}</span>
                            @if($member->no_hp)
                                <p class="mt-2 mb-0"><small class="text-muted"><i class="fas fa-phone"></i> {{ $member->no_hp }}</small></p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x mb-3" style="color: #ccc;"></i>
                <p class="text-muted">Data anggota belum tersedia.</p>
            </div>
        @endif
    </section>

    <!-- Kegiatan Section -->
    <section class="mb-5" data-aos="fade-up">
        <h2 style="color: #1a5f4a; text-align: center; margin-bottom: 30px;">
            <i class="fas fa-calendar-alt"></i> Kegiatan Karang Taruna
        </h2>

        @if($kegiatan->count() > 0)
            <div class="row">
                @foreach($kegiatan as $item)
                <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card h-100" style="border: none; box-shadow: 0 3px 10px rgba(0,0,0,0.08); border-radius: 15px; overflow: hidden;">
                        @if($item->foto)
                            <div style="overflow: hidden;">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                            </div>
                        @else
                            <div style="height: 200px; background: linear-gradient(135deg, #1a5f4a, #2d7d63); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image fa-3x" style="color: rgba(255,255,255,0.5);"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="color: #1a5f4a;">{{ $item->judul }}</h5>
                            <div class="mb-2">
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i> {{ $item->tanggal->format('d M Y') }}
                                </small>
                                @if($item->lokasi)
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> {{ $item->lokasi }}
                                    </small>
                                @endif
                            </div>
                            @if($item->deskripsi)
                                <p class="card-text text-muted">{{ Str::limit($item->deskripsi, 120) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-calendar-times fa-3x mb-3" style="color: #ccc;"></i>
                <p class="text-muted">Belum ada kegiatan yang ditambahkan.</p>
            </div>
        @endif
    </section>

    <!-- Sosial Media -->
    <section data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center">
                <div class="card" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 15px; background: linear-gradient(135deg, #1a5f4a, #2d7d63); color: white;">
                    <div class="card-body p-4">
                        <h4><i class="fas fa-share-alt"></i> Ikuti Kami</h4>
                        <p>Tetap terhubung dengan Karang Taruna Tunas Bangsa</p>
                        <a href="https://www.instagram.com/kartar_tunasbangsaa?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                            target="_blank"
                            style="display: inline-block; background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); color: white; padding: 10px 25px; border-radius: 25px; text-decoration: none; font-weight: 600;">
                            <i class="fab fa-instagram fa-lg"></i> @kartar_tunasbangsaa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<style>
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
