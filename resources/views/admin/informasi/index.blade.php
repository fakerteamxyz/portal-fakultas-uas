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
                <th>Judul</th>
                <th>Penulis</th>
                <th>Publikasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($informasis as $info)
                <tr>
                    <td>{{ $info->judul }}</td>
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
