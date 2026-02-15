@extends('admin.layout')

@section('page-title', 'Edit Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit"></i> Form Edit Berita</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label"><strong>Judul Berita</strong></label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $berita->judul) }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Deskripsi Singkat</strong></label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" required>{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Konten Lengkap</strong></label>
                <textarea class="form-control @error('konten') is-invalid @enderror" name="konten" rows="8" required>{{ old('konten', $berita->konten) }}</textarea>
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
                            <option value="Pemerintahan" {{ old('kategori', $berita->kategori) == 'Pemerintahan' ? 'selected' : '' }}>Pemerintahan</option>
                            <option value="PKK" {{ old('kategori', $berita->kategori) == 'PKK' ? 'selected' : '' }}>PKK</option>
                            <option value="Karang Taruna" {{ old('kategori', $berita->kategori) == 'Karang Taruna' ? 'selected' : '' }}>Karang Taruna</option>
                            <option value="Pemberdayaan" {{ old('kategori', $berita->kategori) == 'Pemberdayaan' ? 'selected' : '' }}>Pemberdayaan</option>
                            <option value="Pelatihan" {{ old('kategori', $berita->kategori) == 'Pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                            <option value="Informasi" {{ old('kategori', $berita->kategori) == 'Informasi' ? 'selected' : '' }}>Informasi</option>
                            <option value="Pengumuman" {{ old('kategori', $berita->kategori) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Penulis</strong></label>
                        <input type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis" value="{{ old('penulis', $berita->penulis) }}" required>
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Gambar</strong></label>
                @if ($berita->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar berita" style="max-width: 200px; border-radius: 5px;">
                    </div>
                @endif
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" id="gambar" accept="image/*">
                <small class="text-muted">Maks 2MB, format: JPG, PNG (Kosongkan jika tidak ingin mengubah gambar)</small>
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dipublikasikan" id="dipublikasikan" value="1" {{ old('dipublikasikan', $berita->dipublikasikan) ? 'checked' : '' }}>
                    <label class="form-check-label" for="dipublikasikan">
                        <strong>Publikasikan</strong>
                    </label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
