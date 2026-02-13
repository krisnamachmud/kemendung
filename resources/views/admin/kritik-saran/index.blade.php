@extends('admin.layout')

@section('title', 'Kelola Kritik & Saran')
@section('page-title', 'Kelola Kritik & Saran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>
        Kritik & Saran
        @if($countBaru > 0)
            <span class="badge bg-danger">{{ $countBaru }} Baru</span>
        @endif
    </h4>
    <div class="d-flex gap-2">
        <select onchange="window.location.href='{{ route('admin.kritik-saran.index') }}?status='+this.value+'&jenis={{ request('jenis') }}'" class="form-select form-select-sm" style="width: auto;">
            <option value="">Semua Status</option>
            <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
            <option value="dibaca" {{ request('status') == 'dibaca' ? 'selected' : '' }}>Dibaca</option>
            <option value="ditanggapi" {{ request('status') == 'ditanggapi' ? 'selected' : '' }}>Ditanggapi</option>
        </select>
        <select onchange="window.location.href='{{ route('admin.kritik-saran.index') }}?jenis='+this.value+'&status={{ request('status') }}'" class="form-select form-select-sm" style="width: auto;">
            <option value="">Semua Jenis</option>
            <option value="kritik" {{ request('jenis') == 'kritik' ? 'selected' : '' }}>Kritik</option>
            <option value="saran" {{ request('jenis') == 'saran' ? 'selected' : '' }}>Saran</option>
            <option value="masukan" {{ request('jenis') == 'masukan' ? 'selected' : '' }}>Masukan</option>
            <option value="pertanyaan" {{ request('jenis') == 'pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
        </select>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
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
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                    <tr style="{{ $item->status == 'baru' ? 'background: #fff3cd;' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td><small>{{ $item->created_at->format('d/m/Y H:i') }}</small></td>
                        <td>
                            <strong>{{ $item->nama }}</strong>
                            @if($item->email)
                                <br><small class="text-muted">{{ $item->email }}</small>
                            @endif
                        </td>
                        <td>
                            @switch($item->jenis)
                                @case('kritik')
                                    <span class="badge bg-danger">Kritik</span>
                                    @break
                                @case('saran')
                                    <span class="badge bg-info">Saran</span>
                                    @break
                                @case('masukan')
                                    <span class="badge bg-primary">Masukan</span>
                                    @break
                                @case('pertanyaan')
                                    <span class="badge bg-warning text-dark">Pertanyaan</span>
                                    @break
                            @endswitch
                        </td>
                        <td>{{ Str::limit($item->pesan, 60) }}</td>
                        <td>
                            @switch($item->status)
                                @case('baru')
                                    <span class="badge bg-warning text-dark"><i class="fas fa-envelope"></i> Baru</span>
                                    @break
                                @case('dibaca')
                                    <span class="badge bg-info"><i class="fas fa-envelope-open"></i> Dibaca</span>
                                    @break
                                @case('ditanggapi')
                                    <span class="badge bg-success"><i class="fas fa-reply"></i> Ditanggapi</span>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('admin.kritik-saran.show', $item) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.kritik-saran.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus data ini?')">
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
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data kritik & saran</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
