@extends('admin.layout')

@section('page-title', 'Kelola Berita')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-newspaper"></i> Daftar Berita</h5>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($berita as $item)
                        <tr>
                            <td>{{ ($berita->currentPage() - 1) * $berita->perPage() + $loop->iteration }}</td>
                            <td>
                                <strong>{{ $item->judul }}</strong><br>
                                <small class="text-muted">{{ substr($item->deskripsi, 0, 50) }}...</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->kategori }}</span>
                            </td>
                            <td>{{ $item->penulis }}</td>
                            <td>
                                @if ($item->dipublikasikan)
                                    <span class="badge bg-success">Dipublikasikan</span>
                                @else
                                    <span class="badge bg-warning">Draft</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada berita</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $berita->links() }}
        </div>
    </div>
</div>
@endsection
