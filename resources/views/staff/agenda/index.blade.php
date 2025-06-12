@extends('layouts.staff')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark fw-black" style="text-transform: uppercase; letter-spacing: 0.5px;">Agenda Internal</h1>
    <a href="{{ route('staff.agenda.create') }}" class="neo-btn neo-btn-primary">
        <i class="fas fa-plus fa-sm me-1"></i> Tambah Agenda
    </a>
</div>
<div class="neo-card mb-4">
    <div class="neo-card-header py-3">
        <h6 class="m-0 font-weight-bold">Daftar Agenda Internal</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="neo-table table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agendas as $agenda)
                    <tr>
                        <td>{{ $agenda->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y, H:i') }}</td>
                        <td>{{ Str::limit($agenda->deskripsi, 60) }}</td>
                        <td>
                            <a href="{{ route('staff.agenda.edit', $agenda->id) }}" class="neo-btn neo-btn-secondary me-2" style="font-size: 0.8rem; padding: 5px 10px;"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('staff.agenda.destroy', $agenda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus agenda ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="neo-btn neo-btn-primary" style="font-size: 0.8rem; padding: 5px 10px;"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4" style="font-weight: 700;">Belum ada agenda internal.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
