@extends('admin.layout')

@section('page-title', 'Tambah Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-plus"></i> Form Tambah Berita</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label"><strong>Judul Berita</strong></label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Deskripsi Singkat</strong></label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Konten Lengkap</strong></label>
                <textarea class="form-control @error('konten') is-invalid @enderror" name="konten" rows="8" required>{{ old('konten') }}</textarea>
                @error('konten')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Kategori</strong></label>
                        <select class="form-control @error('kategori') is-invalid @enderror" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Pemerintahan" {{ old('kategori') == 'Pemerintahan' ? 'selected' : '' }}>Pemerintahan</option>
                            <option value="PKK" {{ old('kategori') == 'PKK' ? 'selected' : '' }}>PKK</option>
                            <option value="Karang Taruna" {{ old('kategori') == 'Karang Taruna' ? 'selected' : '' }}>Karang Taruna</option>
                            <option value="Pemberdayaan" {{ old('kategori') == 'Pemberdayaan' ? 'selected' : '' }}>Pemberdayaan</option>
                            <option value="Pelatihan" {{ old('kategori') == 'Pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                            <option value="Informasi" {{ old('kategori') == 'Informasi' ? 'selected' : '' }}>Informasi</option>
                            <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Penulis</strong></label>
                        <input type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis" value="{{ old('penulis', 'Admin Desa') }}" required>
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Gambar</strong></label>
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" accept="image/*">
                <small class="text-muted">Maks 2MB, format: JPG, PNG</small>
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dipublikasikan" id="dipublikasikan" value="1" {{ old('dipublikasikan') ? 'checked' : '' }}>
                    <label class="form-check-label" for="dipublikasikan">
                        <strong>Publikasikan Sekarang</strong> (Jika tidak dicentang, akan disimpan sebagai draft)
                    </label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
