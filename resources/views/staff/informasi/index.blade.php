@extends('layouts.staff')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Informasi Administratif</h1>
    <a href="{{ route('staff.informasi.create') }}" class="btn btn-primary mb-3">Tambah Informasi</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
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
                                    <a href="{{ route('staff.informasi.show', $informasi->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('staff.informasi.edit', $informasi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('staff.informasi.destroy', $informasi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada informasi administratif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
