@extends('admin.layout')

@section('title', 'Detail Kritik & Saran')
@section('page-title', 'Detail Kritik & Saran')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Pesan -->
        <div class="card mb-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div class="card-header" style="background: #3498db; color: white;">
                <h5 class="mb-0"><i class="fas fa-envelope-open-text"></i> Pesan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama:</strong> {{ $item->nama }}
                    </div>
                    <div class="col-md-6">
                        <strong>Tanggal:</strong> {{ $item->created_at->format('d M Y, H:i') }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Email:</strong> {{ $item->email ?? '-' }}
                    </div>
                    <div class="col-md-6">
                        <strong>No HP:</strong> {{ $item->no_hp ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Jenis:</strong>
                        @switch($item->jenis)
                            @case('kritik') <span class="badge bg-danger">Kritik</span> @break
                            @case('saran') <span class="badge bg-info">Saran</span> @break
                            @case('masukan') <span class="badge bg-primary">Masukan</span> @break
                            @case('pertanyaan') <span class="badge bg-warning text-dark">Pertanyaan</span> @break
                        @endswitch
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong>
                        @switch($item->status)
                            @case('baru') <span class="badge bg-warning text-dark">Baru</span> @break
                            @case('dibaca') <span class="badge bg-info">Dibaca</span> @break
                            @case('ditanggapi') <span class="badge bg-success">Ditanggapi</span> @break
                        @endswitch
                    </div>
                </div>
                <hr>
                <div class="p-3" style="background: #f8f9fa; border-radius: 8px;">
                    <p style="white-space: pre-wrap; margin: 0;">{{ $item->pesan }}</p>
                </div>
            </div>
        </div>

        <!-- Tanggapan yang sudah ada -->
        @if($item->tanggapan)
        <div class="card mb-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 4px solid #28a745;">
            <div class="card-body">
                <h6 style="color: #28a745;"><i class="fas fa-reply"></i> Tanggapan Admin</h6>
                <p style="white-space: pre-wrap;">{{ $item->tanggapan }}</p>
                <small class="text-muted">Ditanggapi pada: {{ $item->ditanggapi_at ? $item->ditanggapi_at->format('d M Y, H:i') : '-' }}</small>
            </div>
        </div>
        @endif

        <!-- Form Tanggapan -->
        <div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div class="card-header" style="background: #28a745; color: white;">
                <h5 class="mb-0"><i class="fas fa-reply"></i> {{ $item->tanggapan ? 'Ubah Tanggapan' : 'Beri Tanggapan' }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kritik-saran.tanggapi', $item) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <textarea name="tanggapan" class="form-control @error('tanggapan') is-invalid @enderror" rows="4"
                            placeholder="Tulis tanggapan Anda..." required>{{ old('tanggapan', $item->tanggapan) }}</textarea>
                        @error('tanggapan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane"></i> Kirim Tanggapan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="d-grid gap-2">
            <a href="{{ route('admin.kritik-saran.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <form action="{{ route('admin.kritik-saran.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-trash"></i> Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
