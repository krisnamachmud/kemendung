@extends('admin.layout')

@section('page-title', 'Edit Perangkat')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit"></i> Form Edit Perangkat Desa</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.perangkat.update', $perangkat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Nama Lengkap</strong></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $perangkat->nama) }}" required>
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
                            <option value="Kepala Desa" {{ old('jabatan', $perangkat->jabatan) == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                            <option value="Sekretaris Desa" {{ old('jabatan', $perangkat->jabatan) == 'Sekretaris Desa' ? 'selected' : '' }}>Sekretaris Desa</option>
                            <option value="Kepala Dusun Kemendung" {{ old('jabatan', $perangkat->jabatan) == 'Kepala Dusun Kemendung' ? 'selected' : '' }}>Kepala Dusun Kemendung</option>
                            <option value="Bendahara Desa" {{ old('jabatan', $perangkat->jabatan) == 'Bendahara Desa' ? 'selected' : '' }}>Bendahara Desa</option>
                            <option value="Perangkat Desa Lainnya" {{ old('jabatan', $perangkat->jabatan) == 'Perangkat Desa Lainnya' ? 'selected' : '' }}>Perangkat Desa Lainnya</option>
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
                        <input type="text" class="form-control @error('dusun') is-invalid @enderror" name="dusun" value="{{ old('dusun', $perangkat->dusun) }}" placeholder="Contoh: Kemendung">
                        @error('dusun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>NIP (Nomor Induk Pegawai)</strong></label>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip', $perangkat->nip) }}" placeholder="Contoh: 19650315 198603 1 004">
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>No. KTP</strong></label>
                <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" name="no_ktp" value="{{ old('no_ktp', $perangkat->no_ktp) }}" placeholder="Contoh: 3507171234567890">
                @error('no_ktp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Foto Profil</strong></label>
                @if ($perangkat->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="{{ $perangkat->nama }}" style="max-width: 200px; border-radius: 5px;">
                    </div>
                @endif
                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" accept="image/*">
                <small class="text-muted">Maks 2MB, format: JPG, PNG (Kosongkan jika tidak ingin mengubah foto)</small>
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.perangkat.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
