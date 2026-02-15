@extends('admin.layout')

@section('page-title', 'Tambah Perangkat')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-plus"></i> Form Tambah Perangkat Desa</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.perangkat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Nama Lengkap</strong></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Jabatan</strong></label>
                        <select class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="Kepala Desa" {{ old('jabatan') == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                            <option value="Sekretaris Desa" {{ old('jabatan') == 'Sekretaris Desa' ? 'selected' : '' }}>Sekretaris Desa</option>
                            <option value="Kepala Dusun Kemendung" {{ old('jabatan') == 'Kepala Dusun Kemendung' ? 'selected' : '' }}>Kepala Dusun Kemendung</option>
                            <option value="Bendahara Desa" {{ old('jabatan') == 'Bendahara Desa' ? 'selected' : '' }}>Bendahara Desa</option>
                            <option value="Perangkat Desa Lainnya" {{ old('jabatan') == 'Perangkat Desa Lainnya' ? 'selected' : '' }}>Perangkat Desa Lainnya</option>
                        </select>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Dusun</strong></label>
                        <input type="text" class="form-control @error('dusun') is-invalid @enderror" name="dusun" value="{{ old('dusun') }}" placeholder="Contoh: Kemendung">
                        @error('dusun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>NIP (Nomor Induk Pegawai)</strong></label>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" placeholder="Contoh: 19650315 198603 1 004">
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>No. KTP</strong></label>
                <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" name="no_ktp" value="{{ old('no_ktp') }}" placeholder="Contoh: 3507171234567890">
                @error('no_ktp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Foto Profil</strong></label>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto" accept="image/jpeg,image/png" onchange="validateFileSize(this, 2)">
                <small class="text-muted">Maks 2MB, format: JPG, PNG</small>
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.perangkat.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
