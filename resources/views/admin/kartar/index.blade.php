@extends('admin.layout')

@section('title', 'Kelola Anggota Karang Taruna')
@section('page-title', 'Kelola Anggota Karang Taruna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Anggota</h4>
    <a href="{{ route('admin.kartar.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Anggota
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
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>No HP</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota as $index => $member)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($member->foto)
                                <img src="{{ asset('storage/' . $member->foto) }}" alt="{{ $member->nama }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                            @else
                                <div style="width: 50px; height: 50px; background: #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $member->nama }}</td>
                        <td><span class="badge bg-success">{{ $member->jabatan }}</span></td>
                        <td>{{ $member->no_hp ?? '-' }}</td>
                        <td>{{ $member->urutan }}</td>
                        <td>
                            @if($member->ditampilkan)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.kartar.edit', $member) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.kartar.destroy', $member) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus anggota ini?')">
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
                        <td colspan="8" class="text-center text-muted py-4">Belum ada data anggota</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
