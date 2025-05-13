@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Daftar Kategori Agenda</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.kategori-agenda.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori as $kat)
                <tr>
                    <td>{{ $kat->nama }}</td>
                    <td>{{ $kat->deskripsi }}</td>
                    <td>
                        <a href="{{ route('admin.kategori-agenda.edit', $kat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.kategori-agenda.destroy', $kat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
