@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
@php
    $user = \App\Models\User::find(session('admin_id'));
@endphp

{{-- Dashboard untuk Administrator --}}
@if($user && $user->isAdministrator())
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Total Berita</h5>
                        <h2 class="mt-2">{{ $total_berita }}</h2>
                    </div>
                    <i class="fas fa-newspaper fa-3x" style="opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Dipublikasikan</h5>
                        <h2 class="mt-2">{{ $berita_published }}</h2>
                    </div>
                    <i class="fas fa-check-circle fa-3x" style="opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Draft</h5>
                        <h2 class="mt-2">{{ $berita_draft }}</h2>
                    </div>
                    <i class="fas fa-file-alt fa-3x" style="opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Total Perangkat</h5>
                        <h2 class="mt-2">{{ $total_perangkat }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x" style="opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-map"></i> Statistik Desa</h5>
            </div>
            <div class="card-body">
                @if ($statistik)
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Penduduk Laki-laki</strong></td>
                            <td>{{ $statistik->penduduk_laki }} orang</td>
                        </tr>
                        <tr>
                            <td><strong>Penduduk Perempuan</strong></td>
                            <td>{{ $statistik->penduduk_perempuan }} orang</td>
                        </tr>
                        <tr>
                            <td><strong>Total Penduduk</strong></td>
                            <td>{{ $statistik->penduduk_laki + $statistik->penduduk_perempuan }} orang</td>
                        </tr>
                        <tr>
                            <td><strong>Kepala Keluarga</strong></td>
                            <td>{{ $statistik->kepala_keluarga }} KK</td>
                        </tr>
                        <tr>
                            <td><strong>Luas Wilayah</strong></td>
                            <td>{{ $statistik->luas_wilayah }} km²</td>
                        </tr>
                        <tr>
                            <td><strong>Jumlah Dusun</strong></td>
                            <td>{{ $statistik->jumlah_dusun }} dusun</td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.statistik.edit') }}" class="btn btn-sm btn-primary mt-3">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                @else
                    <p class="text-muted">Tidak ada data statistik. <a href="{{ route('admin.statistik.edit') }}">Buat data statistik</a></p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Sistem</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Nama Desa</strong></td>
                        <td>Jatirejo</td>
                    </tr>
                    <tr>
                        <td><strong>Kecamatan</strong></td>
                        <td>Tikung</td>
                    </tr>
                    <tr>
                        <td><strong>Kabupaten</strong></td>
                        <td>Lamongan</td>
                    </tr>
                    <tr>
                        <td><strong>Dusun Utama</strong></td>
                        <td>Kemendung</td>
                    </tr>
                    <tr>
                        <td><strong>Total Perangkat</strong></td>
                        <td>{{ $total_perangkat }} orang</td>
                    </tr>
                    <tr>
                        <td><strong>Versi Laravel</strong></td>
                        <td>11.x</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Dashboard untuk Kartar --}}
@if($user && $user->isKartar())
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Total Kegiatan</h5>
                        <h2 class="mt-2">{{ $total_kegiatan ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-calendar-alt fa-3x" style="opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Total Anggota</h5>
                        <h2 class="mt-2">{{ $total_anggota ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-user-friends fa-3x" style="opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Kegiatan Bulan Ini</h5>
                        <h2 class="mt-2">{{ $kegiatan_bulan_ini ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-calendar-check fa-3x" style="opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Kegiatan Terbaru</h5>
                <a href="{{ route('admin.kartar-kegiatan.index') }}" class="btn btn-sm btn-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if(isset($kegiatan_terbaru) && $kegiatan_terbaru->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kegiatan_terbaru as $kegiatan)
                            <tr>
                                <td>{{ $kegiatan->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $kegiatan->status == 'selesai' ? 'success' : 'warning' }}">
                                        {{ ucfirst($kegiatan->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted text-center">Belum ada kegiatan.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-bolt"></i> Aksi Cepat</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.kartar-kegiatan.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus"></i> Tambah Kegiatan
                </a>
                <a href="{{ route('admin.kartar.index') }}" class="btn btn-success me-2">
                    <i class="fas fa-user-friends"></i> Kelola Anggota
                </a>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
