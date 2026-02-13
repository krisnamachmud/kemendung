@extends('layouts.app')

@section('title', 'Statistik Dusun')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white; padding: 60px 0; margin-bottom: 40px;">
    <div class="container">
        <h1 data-aos="fade-right">Statistik Dusun Kemendung</h1>
        <p data-aos="fade-right" data-aos-delay="200">Data Demografis dan Informasi Wilayah</p>
    </div>
</section>

<div class="container mb-5">
    @if ($statistik)
        <!-- Statistik Utama -->
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-box" style="background: linear-gradient(135deg, #3498db, #2980b9); color: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <i class="fas fa-male" style="font-size: 2.5rem; margin-bottom: 15px; display: block;"></i>
                    <div style="font-size: 0.95rem; opacity: 0.9;">Penduduk Laki-laki</div>
                    <div class="stat-number" style="font-size: 2.5rem; font-weight: 700; margin: 15px 0;">{{ number_format($statistik->penduduk_laki) }}</div>
                    <small>orang</small>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-box" style="background: linear-gradient(135deg, #85c1e2, #5da3c9); color: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <i class="fas fa-female" style="font-size: 2.5rem; margin-bottom: 15px; display: block;"></i>
                    <div style="font-size: 0.95rem; opacity: 0.9;">Penduduk Perempuan</div>
                    <div class="stat-number" style="font-size: 2.5rem; font-weight: 700; margin: 15px 0;">{{ number_format($statistik->penduduk_perempuan) }}</div>
                    <small>orang</small>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-box" style="background: linear-gradient(135deg, #5dade2, #3498db); color: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <i class="fas fa-home" style="font-size: 2.5rem; margin-bottom: 15px; display: block;"></i>
                    <div style="font-size: 0.95rem; opacity: 0.9;">Kepala Keluarga</div>
                    <div class="stat-number" style="font-size: 2.5rem; font-weight: 700; margin: 15px 0;">{{ number_format($statistik->kepala_keluarga) }}</div>
                    <small>KK</small>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-box" style="background: linear-gradient(135deg, #2980b9, #21618c); color: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <i class="fas fa-map" style="font-size: 2.5rem; margin-bottom: 15px; display: block;"></i>
                    <div style="font-size: 0.95rem; opacity: 0.9;">Luas Wilayah</div>
                    <div class="stat-number" style="font-size: 2.5rem; font-weight: 700; margin: 15px 0;">{{ number_format($statistik->luas_wilayah, 2) }}</div>
                    <small>Hektar</small>
                </div>
            </div>
        </div>

        <!-- Ringkasan Demografi -->
        <div class="row mb-5">
            <div class="col-lg-6 col-md-12" data-aos="fade-right" data-aos-delay="100">
                <div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #3498db, #2980b9); color: white;">
                        <h5 class="mb-0"><i class="fas fa-users"></i> Komposisi Penduduk</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="populationChart"></canvas>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Penduduk:</span>
                                <strong>{{ number_format($statistik->penduduk_laki + $statistik->penduduk_perempuan) }} orang</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Rasio L/P:</span>
                                <strong>
                                    @php
                                        $ratio = $statistik->penduduk_laki + $statistik->penduduk_perempuan > 0
                                            ? round(($statistik->penduduk_laki / ($statistik->penduduk_laki + $statistik->penduduk_perempuan)) * 100, 2)
                                            : 0
                                    @endphp
                                    {{ $ratio }}% / {{ 100 - $ratio }}%
                                </strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Rata-rata per KK:</span>
                                <strong>
                                    @php
                                        $avgKK = $statistik->kepala_keluarga > 0
                                            ? round(($statistik->penduduk_laki + $statistik->penduduk_perempuan) / $statistik->kepala_keluarga, 2)
                                            : 0
                                    @endphp
                                    {{ $avgKK }} orang
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12" data-aos="fade-left" data-aos-delay="200">
                <div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #5dade2, #3498db); color: white;">
                        <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Distribusi Data</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="distributionChart"></canvas>
                        <div class="mt-3">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>Laki-laki:</strong></td>
                                        <td>{{ number_format($statistik->penduduk_laki) }} orang</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Perempuan:</strong></td>
                                        <td>{{ number_format($statistik->penduduk_perempuan) }} orang</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kepala Keluarga:</strong></td>
                                        <td>{{ number_format($statistik->kepala_keluarga) }} KK</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Wilayah -->
        <div class="row mb-5">
            <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: linear-gradient(135deg, #85c1e2, #5dade2); color: #1a1a1a;">
                        <h5 class="mb-0"><i class="fas fa-globe"></i> Informasi Wilayah</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-12 mb-3">
                                <h6 style="color: #1a5f4a;">Luas Wilayah Desa</h6>
                                <p class="h4">{{ number_format($statistik->luas_wilayah, 2) }} Ha</p>
                                <small class="text-muted">
                                    Setara dengan {{ number_format($statistik->luas_wilayah * 10000, 0) }} m²
                                </small>
                            </div>
                            <div class="col-sm-6 col-12 mb-3">
                                <h6 style="color: #3498db;">Jumlah Dusun</h6>
                                <p class="h4">{{ $statistik->jumlah_dusun }} Dusun</p>
                                <small class="text-muted">
                                    Dusun Kemendung terdiri dari {{ $statistik->jumlah_dusun }} dusun
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Tambahan -->
        <div class="row">
            <div class="col-12" data-aos="zoom-in" data-aos-delay="200">
                <div class="alert alert-info border-0" style="background: linear-gradient(135deg, #d6eaf8, #aed6f1); color: #2980b9;">
                    <h6 class="mb-3"><i class="fas fa-info-circle"></i> Informasi Dusun Kemendung</h6>
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <p><strong>Lokasi:</strong> Dsn. Kemendung, Jatirejo, Tikung, Lamongan</p>
                            <p><strong>Kecamatan:</strong> Tikung</p>
                            <p><strong>Kabupaten:</strong> Lamongan</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Provinsi:</strong> Jawa Timur</p>
                            <p><strong>Dusun Utama:</strong> Kemendung</p>
                            <p><strong>Statistik Terakhir Diperbarui:</strong> {{ $statistik->updated_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center" data-aos="fade-up">
            <i class="fas fa-exclamation-triangle"></i> Data statistik desa belum tersedia. Silakan hubungi admin untuk menambahkan data.
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    @if ($statistik)
    // Chart Komposisi Penduduk (Pie)
    const populationCtx = document.getElementById('populationChart').getContext('2d');
    new Chart(populationCtx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $statistik->penduduk_laki }}, {{ $statistik->penduduk_perempuan }}],
                backgroundColor: ['#3498db', '#e74c3c'],
                borderColor: ['#2980b9', '#c0392b'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });

    // Chart Distribusi Data (Bar)
    const distributionCtx = document.getElementById('distributionChart').getContext('2d');
    new Chart(distributionCtx, {
        type: 'bar',
        data: {
            labels: ['Laki-laki', 'Perempuan', 'KK'],
            datasets: [{
                label: 'Jumlah',
                data: [
                    {{ $statistik->penduduk_laki }},
                    {{ $statistik->penduduk_perempuan }},
                    {{ $statistik->kepala_keluarga }}
                ],
                backgroundColor: ['#3498db', '#e74c3c', '#f39c12'],
                borderColor: ['#2980b9', '#c0392b', '#e67e22'],
                borderWidth: 2
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
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
    @endif
</script>
@endsection
