@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Daftar Informasi</h3>
    <a href="{{ route('admin.informasi.create') }}" class="btn btn-primary mb-3">+ Tambah Informasi</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="25%">Judul</th>
                <th width="10%">Gambar</th>
                <th width="15%">Penulis</th>
                <th width="15%">Agenda Terkait</th>
                <th width="15%">Publikasi</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($informasis as $info)
                <tr>
                    <td>{{ $info->judul }}</td>
                    <td>
                        @if($info->gambar)
                            <img src="{{ asset($info->gambar) }}" alt="{{ $info->judul }}" width="100" class="img-thumbnail">
                        @else
                            <span class="badge bg-light text-dark">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>{{ $info->user->name }}</td>
                    <td>
                        @if($info->agenda)
                            <span class="badge bg-info text-dark">{{ $info->agenda->judul }}</span>
                        @else
                            <span class="badge bg-light text-dark">-</span>
                        @endif
                    </td>
                    <td>
                        @if($info->is_published)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.informasi.show', $info->id) }}" class="btn btn-sm btn-info mb-1">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.informasi.edit', $info->id) }}" class="btn btn-sm btn-warning mb-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.informasi.destroy', $info->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Belum ada informasi.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $informasis->links() }}
</div>
@endsection
