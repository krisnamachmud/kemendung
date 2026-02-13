@extends('admin.layout')

@section('title', 'Kelola Kegiatan Karang Taruna')
@section('page-title', 'Kelola Kegiatan Karang Taruna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Kegiatan</h4>
    <a href="{{ route('admin.kartar-kegiatan.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Kegiatan
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead style="background: #3498db; color: white;">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 5px;">
                            @else
                                <div style="width: 60px; height: 40px; background: #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tanggal->format('d M Y') }}</td>
                        <td>{{ $item->lokasi ?? '-' }}</td>
                        <td>
                            @if($item->ditampilkan)
                                <span class="badge bg-success">Tampil</span>
                            @else
                                <span class="badge bg-secondary">Sembunyi</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.kartar-kegiatan.edit', $item) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.kartar-kegiatan.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus kegiatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data kegiatan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
