@extends('layouts.app')

@section('title', 'Kritik & Saran')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #1a5f4a 0%, #2d7d63 100%); color: white; padding: 60px 0; margin-bottom: 40px;">
    <div class="container">
        <h1 data-aos="fade-right"><i class="fas fa-comments"></i> Kritik & Saran</h1>
        <p data-aos="fade-right" data-aos-delay="200">Sampaikan masukan Anda untuk kemajuan Dusun Kemendung</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row">
        <!-- Form -->
        <div class="col-lg-7 mb-4" data-aos="fade-right">
            <div class="card" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 15px;">
                <div class="card-body p-4">
                    <h4 style="color: #1a5f4a; margin-bottom: 20px;">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </h4>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('kritik-saran.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}" placeholder="Masukkan nama Anda" required>
                                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="email@contoh.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="fas fa-phone"></i> No HP</label>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                    value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx">
                                @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="fas fa-tag"></i> Jenis Pesan <span class="text-danger">*</span></label>
                                <select name="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="kritik" {{ old('jenis') == 'kritik' ? 'selected' : '' }}>Kritik</option>
                                    <option value="saran" {{ old('jenis') == 'saran' ? 'selected' : '' }}>Saran</option>
                                    <option value="masukan" {{ old('jenis') == 'masukan' ? 'selected' : '' }}>Masukan</option>
                                    <option value="pertanyaan" {{ old('jenis') == 'pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                                </select>
                                @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label"><i class="fas fa-message"></i> Pesan <span class="text-danger">*</span></label>
                                <textarea name="pesan" class="form-control @error('pesan') is-invalid @enderror"
                                    rows="5" placeholder="Tulis kritik, saran, atau pertanyaan Anda di sini..." required>{{ old('pesan') }}</textarea>
                                @error('pesan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <small class="text-muted">Maksimal 2000 karakter</small>
                            </div>
                        </div>

                        <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #1a5f4a, #2d7d63); color: white; padding: 12px; font-weight: 600; border-radius: 8px;">
                            <i class="fas fa-paper-plane"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info -->
        <div class="col-lg-5 mb-4" data-aos="fade-left">
            <div class="card mb-4" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 15px; background: linear-gradient(135deg, #1a5f4a, #2d7d63); color: white;">
                <div class="card-body p-4">
                    <h5><i class="fas fa-info-circle"></i> Informasi</h5>
                    <p>Kami sangat menghargai setiap masukan dari warga untuk kemajuan Dusun Kemendung. Pesan Anda akan kami proses dan tanggapi secepatnya.</p>
                    <hr style="border-color: rgba(255,255,255,0.3);">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Pesan dijamin kerahasiaannya</li>
                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Ditanggapi dalam 1-3 hari kerja</li>
                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Kritik membangun untuk kemajuan dusun</li>
                    </ul>
                </div>
            </div>

            <div class="card mb-4" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 style="color: #1a5f4a;"><i class="fas fa-headset"></i> Kontak Langsung</h5>
                    <p class="mb-2"><i class="fas fa-phone text-muted me-2"></i> {{ config('app.desa_kontak', '(0321) 123-4567') }}</p>
                    <p class="mb-2"><i class="fas fa-envelope text-muted me-2"></i> {{ config('app.desa_email', 'admin@jatirejo-desa.id') }}</p>
                    <p class="mb-0"><i class="fas fa-clock text-muted me-2"></i> Senin - Jumat, 08:00 - 15:00 WIB</p>
                </div>
            </div>

            <div class="card" style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 15px;">
                <div class="card-body p-4 text-center">
                    <h5 style="color: #1a5f4a;"><i class="fab fa-instagram"></i> Follow Kami</h5>
                    <a href="https://www.instagram.com/kartar_tunasbangsaa?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        target="_blank"
                        style="display: inline-block; background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); color: white; padding: 8px 20px; border-radius: 20px; text-decoration: none; font-weight: 600;">
                        <i class="fab fa-instagram"></i> @kartar_tunasbangsaa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
