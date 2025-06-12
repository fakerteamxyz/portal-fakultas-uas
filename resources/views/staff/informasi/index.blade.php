@extends('layouts.staff')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-dark fw-black" style="text-transform: uppercase; letter-spacing: 0.5px;">Informasi Administratif</h1>
    <a href="{{ route('staff.informasi.create') }}" class="neo-btn neo-btn-primary mb-4">
        <i class="fas fa-plus fa-sm me-1"></i> Tambah Informasi
    </a>
    @if(session('success'))
        <div class="alert alert-success" style="border: 4px solid var(--dark); background-color: var(--accent); color: var(--dark); font-weight: 700;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif
    <div class="neo-card mb-4">
        <div class="neo-card-header py-3">
            <h6 class="m-0 font-weight-bold">Daftar Informasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="neo-table table table-bordered">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($informasis as $informasi)
                            <tr>
                                <td>{{ $informasi->judul }}</td>
                                <td>{{ $informasi->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('staff.informasi.show', $informasi->id) }}" class="neo-btn neo-btn-accent me-2" style="font-size: 0.8rem; padding: 5px 10px;">
                                        <i class="fas fa-eye me-1"></i> Lihat
                                    </a>
                                    <a href="{{ route('staff.informasi.edit', $informasi->id) }}" class="neo-btn neo-btn-secondary me-2" style="font-size: 0.8rem; padding: 5px 10px;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('staff.informasi.destroy', $informasi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="neo-btn neo-btn-primary" style="font-size: 0.8rem; padding: 5px 10px;">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4" style="font-weight: 700;">Belum ada informasi administratif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
