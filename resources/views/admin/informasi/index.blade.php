@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Daftar Informasi</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.informasi.create') }}" class="btn btn-primary mb-3">+ Tambah Informasi</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="30%">Judul</th>
                <th width="15%">Gambar</th>
                <th width="20%">Penulis</th>
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
                        @if($info->is_published)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.informasi.edit', $info->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.informasi.destroy', $info->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada informasi.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $informasis->links() }}
</div>
@endsection
