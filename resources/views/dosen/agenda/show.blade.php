@extends('layouts.dosen')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Agenda</h1>
        <div>
            <a href="{{ route('dosen.agenda.edit', $agenda->id) }}" class="btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
            <a href="{{ route('dosen.agenda.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    @include('dosen.partials.alerts')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $agenda->judul }}</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Tanggal dan Waktu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y, H:i') }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Kategori</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $agenda->kategori->nama ?? 'Tidak Terkategori' }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tag fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Deskripsi</h6>
                </div>
                <div class="card-body">
                    {!! nl2br(e($agenda->deskripsi)) !!}
                </div>
            </div>

            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Tambahan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Dibuat pada:</strong> {{ $agenda->created_at->format('d M Y, H:i') }}</p>
                            <p><strong>Terakhir diupdate:</strong> {{ $agenda->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <strong>Status:</strong>
                                @if(\Carbon\Carbon::parse($agenda->tanggal)->isFuture())
                                    <span class="badge badge-success">Akan Datang</span>
                                @else
                                    <span class="badge badge-secondary">Selesai</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
