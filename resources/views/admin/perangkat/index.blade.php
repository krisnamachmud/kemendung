@extends('admin.layout')

@section('page-title', 'Kelola Perangkat')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-users"></i> Daftar Perangkat Desa</h5>
        <a href="{{ route('admin.perangkat.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Perangkat
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Dusun</th>
                        <th>NIP</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($perangkat as $item)
                        <tr>
                            <td>{{ ($perangkat->currentPage() - 1) * $perangkat->perPage() + $loop->iteration }}</td>
                            <td><strong>{{ $item->nama }}</strong></td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->jabatan }}</span>
                            </td>
                            <td>{{ $item->dusun ?? '-' }}</td>
                            <td>{{ $item->nip ?? '-' }}</td>
                            <td>
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" style="max-width: 50px; border-radius: 5px;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.perangkat.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.perangkat.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus perangkat ini?')">
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
                            <td colspan="7" class="text-center text-muted">Tidak ada perangkat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $perangkat->links() }}
        </div>
    </div>
</div>
@endsection
