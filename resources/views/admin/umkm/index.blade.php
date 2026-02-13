@extends('admin.layout')

@section('title', 'Manajemen UMKM')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Manajemen UMKM</h1>
        <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah UMKM
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($umkms->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada UMKM terdaftar</p>
                    <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary">
                        Tambah UMKM Pertama
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Logo</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Pemilik</th>
                                <th>Kontak</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($umkms as $umkm)
                                <tr>
                                    <td>
                                        @if($umkm->logo)
                                            <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->nama }}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 5px;">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $umkm->nama }}</strong><br>
                                        <small class="text-muted">{{ Str::limit($umkm->deskripsi, 30) }}</small>
                                    </td>
                                    <td>{{ $umkm->kategori }}</td>
                                    <td>{{ $umkm->pemilik ?? '-' }}</td>
                                    <td>{{ $umkm->kontak ?? '-' }}</td>
                                    <td>
                                        @if($umkm->ditampilkan)
                                            <span class="badge bg-success">Ditampilkan</span>
                                        @else
                                            <span class="badge bg-secondary">Tersembunyi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
