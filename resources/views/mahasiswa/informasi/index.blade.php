@extends('layouts.mahasiswa')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Informasi</h1>
    
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Informasi</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($informasiList as $info)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    @if($info->gambar)
                                        <img src="{{ asset($info->gambar) }}" class="card-img-top" alt="{{ $info->judul }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light text-center py-5">
                                            <i class="bi bi-info-circle display-4 text-primary"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $info->judul }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($info->konten, 100) }}</p>
                                        
                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                            <span class="badge bg-primary">{{ $info->created_at->format('d M Y') }}</span>
                                            @if($info->user && $info->user->role === 'admin')
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-broadcast me-1"></i> Admin
                                                </span>
                                            @endif
                                            @if($info->agenda)
                                                <span class="badge bg-info text-dark">
                                                    <i class="bi bi-calendar-event me-1"></i> {{ $info->agenda->judul }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bg-light rounded-circle p-1 text-center me-2" style="width: 30px; height: 30px;">
                                                {{ substr($info->user->name, 0, 1) }}
                                            </div>
                                            <small class="text-muted">{{ $info->user->name }}</small>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white border-top-0">
                                        <a href="{{ route('mahasiswa.informasi.show', $info->id) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-eye me-1"></i> Lihat Detail
                                        </a>
                                        @if($info->comments->count() > 0)
                                            <span class="ms-2 text-muted">
                                                <i class="bi bi-chat-dots"></i> {{ $info->comments->count() }} komentar
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i> Belum ada informasi yang tersedia.
                                </div>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $informasiList->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection