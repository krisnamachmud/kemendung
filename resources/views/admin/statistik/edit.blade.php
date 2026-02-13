@extends('admin.layout')

@section('page-title', 'Kelola Statistik Dusun')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Edit Statistik Dusun</h5>
    </div>
    <div class="card-body">
        @if ($statistik && $statistik->id)
            <form action="{{ route('admin.statistik.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> <strong>Informasi:</strong> Data statistik ini ditampilkan di halaman utama dan halaman statistik website dusun.
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Penduduk Laki-laki (orang)</strong></label>
                            <input type="number" class="form-control @error('penduduk_laki') is-invalid @enderror" name="penduduk_laki" value="{{ old('penduduk_laki', $statistik->penduduk_laki) }}" min="0" required>
                            @error('penduduk_laki')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Penduduk Perempuan (orang)</strong></label>
                            <input type="number" class="form-control @error('penduduk_perempuan') is-invalid @enderror" name="penduduk_perempuan" value="{{ old('penduduk_perempuan', $statistik->penduduk_perempuan) }}" min="0" required>
                            @error('penduduk_perempuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Kepala Keluarga (KK)</strong></label>
                            <input type="number" class="form-control @error('kepala_keluarga') is-invalid @enderror" name="kepala_keluarga" value="{{ old('kepala_keluarga', $statistik->kepala_keluarga) }}" min="0" required>
                            @error('kepala_keluarga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Luas Wilayah (km²)</strong></label>
                            <input type="number" step="0.01" class="form-control @error('luas_wilayah') is-invalid @enderror" name="luas_wilayah" value="{{ old('luas_wilayah', $statistik->luas_wilayah) }}" min="0" required>
                            @error('luas_wilayah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Jumlah Dusun</strong></label>
                    <input type="number" class="form-control @error('jumlah_dusun') is-invalid @enderror" name="jumlah_dusun" value="{{ old('jumlah_dusun', $statistik->jumlah_dusun) }}" min="0" required>
                    @error('jumlah_dusun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Statistik Ringkas -->
                <div class="alert alert-light border">
                    <h6 class="mb-3"><strong>📊 Ringkasan Statistik</strong></h6>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <p class="mb-2">
                                <strong>Total Penduduk:</strong><br>
                                <span id="totalPenduduk" style="font-size: 18px; color: #3498db;">0</span> orang
                            </p>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <p class="mb-2">
                                <strong>Persentase Laki-laki:</strong><br>
                                <span id="persenLaki" style="font-size: 18px; color: #3498db;">0%</span>
                            </p>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <p class="mb-2">
                                <strong>Persentase Perempuan:</strong><br>
                                <span id="persenPerempuan" style="font-size: 18px; color: #3498db;">0%</span>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <p class="mb-0">
                                <strong>Rata-rata per KK:</strong><br>
                                <span id="rataRataKK" style="font-size: 18px; color: #3498db;">0</span> orang
                            </p>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <p class="mb-0">
                                <strong>Kepadatan Penduduk:</strong><br>
                                <span id="kepadatanPenduduk" style="font-size: 18px; color: #3498db;">0</span> orang/km²
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        @else
            <p class="text-muted">Tidak ada data statistik. Silakan hubungi administrator.</p>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pendudukLakiInput = document.querySelector('input[name="penduduk_laki"]');
    const pendudukPerempuanInput = document.querySelector('input[name="penduduk_perempuan"]');
    const kepalaKeluargaInput = document.querySelector('input[name="kepala_keluarga"]');
    const luasWilayahInput = document.querySelector('input[name="luas_wilayah"]');

    function updateStatistik() {
        const laki = parseInt(pendudukLakiInput.value) || 0;
        const perempuan = parseInt(pendudukPerempuanInput.value) || 0;
        const kk = parseInt(kepalaKeluargaInput.value) || 0;
        const luas = parseFloat(luasWilayahInput.value) || 0;

        const total = laki + perempuan;
        const persenLaki = total > 0 ? ((laki / total) * 100).toFixed(2) : 0;
        const persenPerempuan = total > 0 ? ((perempuan / total) * 100).toFixed(2) : 0;
        const rataRataKK = kk > 0 ? (total / kk).toFixed(2) : 0;
        const kepadatan = luas > 0 ? (total / luas).toFixed(2) : 0;

        document.getElementById('totalPenduduk').textContent = total.toLocaleString('id-ID');
        document.getElementById('persenLaki').textContent = persenLaki + '%';
        document.getElementById('persenPerempuan').textContent = persenPerempuan + '%';
        document.getElementById('rataRataKK').textContent = rataRataKK;
        document.getElementById('kepadatanPenduduk').textContent = kepadatan;
    }

    pendudukLakiInput.addEventListener('input', updateStatistik);
    pendudukPerempuanInput.addEventListener('input', updateStatistik);
    kepalaKeluargaInput.addEventListener('input', updateStatistik);
    luasWilayahInput.addEventListener('input', updateStatistik);

    updateStatistik();
});
</script>
@endsection
