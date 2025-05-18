@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Daftar Agenda</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary mb-3">+ Tambah Agenda</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="25%">Judul</th>
                <th width="25%">Tanggal</th>
                <th width="15%">Kategori</th>
                <th width="15%">Penulis</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agendas as $agenda)
                <tr>
                    <td>{{ $agenda->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y, H:i') }}</td>
                    <td>{{ $agenda->kategori->nama ?? 'Tidak Terkategori' }}</td>
                    <td>{{ $agenda->user->name }}</td>
                    <td>
                        <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada agenda.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $agendas->links() }}
</div>
@endsection
