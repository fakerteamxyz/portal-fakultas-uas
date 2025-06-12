@extends('layouts.mahasiswa')

@section('content')
<div class="neo-page-header">
    <div class="container">
        <h1>Informasi Penting</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="neo-card">
                <div class="neo-card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Daftar Informasi Terbaru</h6>
                </div>
                <div class="card-body py-4">
                    <div class="row">
                        @forelse($informasiList as $info)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="neo-info-card h-100">
                                    @if($info->gambar)
                                        <img src="{{ asset($info->gambar) }}" class="card-img-top" alt="{{ $info->judul }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light text-center py-5" style="border: 4px solid var(--dark);">
                                            <i class="bi bi-info-circle display-4" style="color: var(--primary);"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">{{ $info->judul }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($info->konten, 100) }}</p>
                                        
                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                            <span class="neo-badge">{{ $info->created_at->format('d M Y') }}</span>
                                            @if($info->user && $info->user->role === 'admin')
                                                <span class="neo-badge" style="background-color: var(--primary); color: white;">
                                                    <i class="bi bi-broadcast me-1"></i> Admin
                                                </span>
                                            @elseif($info->user && $info->user->role === 'dosen')
                                                <span class="neo-badge" style="background-color: var(--accent); color: var(--dark);">
                                                    <i class="bi bi-person-badge me-1"></i> Info Dosen
                                                </span>
                                            @endif
                                            @if($info->agenda)
                                                <span class="neo-badge" style="background-color: var(--secondary); color: var(--dark);">
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
                                    <div class="card-footer bg-white" style="border-top: 4px solid var(--dark)">
                                        <a href="{{ route('mahasiswa.informasi.show', $info->id) }}" class="neo-btn-outline" style="background: var(--primary); color: white; font-size: 0.9rem; padding: 5px 12px;">
                                            <i class="bi bi-eye me-1"></i> Lihat Detail
                                        </a>
                                        @if($info->comments->count() > 0)
                                            <span class="ms-2 neo-badge" style="background-color: var(--accent); font-size: 0.8rem;">
                                                <i class="bi bi-chat-dots me-1"></i> {{ $info->comments->count() }} komentar
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