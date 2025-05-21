@extends('layouts.dosen')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Informasi</h1>
    <div>
        <a href="{{ route('dosen.informasi.edit', $informasi->id) }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-edit fa-sm"></i> Edit
        </a>
        <a href="{{ route('dosen.informasi.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ $informasi->judul }}</h6>
        <div>
            <span class="badge {{ $informasi->is_published ? 'badge-success' : 'badge-secondary' }}">
                {{ $informasi->is_published ? 'Dipublikasikan' : 'Draft' }}
            </span>
        </div>
    </div>
    <div class="card-body">
        @if($informasi->gambar)
            <div class="mb-4 text-center">
                <img src="{{ asset($informasi->gambar) }}" alt="{{ $informasi->judul }}" class="img-fluid" style="max-height: 300px;">
            </div>
        @endif

        <div class="mb-4">
            <h5 class="font-weight-bold">Konten</h5>
            <p>{{ $informasi->konten }}</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5 class="font-weight-bold">Informasi Tambahan</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Dibuat pada:</strong> {{ $informasi->created_at->format('d F Y, H:i') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Diperbarui pada:</strong> {{ $informasi->updated_at->format('d F Y, H:i') }}
                    </li>
                    @if($informasi->agenda)
                    <li class="list-group-item">
                        <strong>Terkait Agenda:</strong> {{ $informasi->agenda->judul }}
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
