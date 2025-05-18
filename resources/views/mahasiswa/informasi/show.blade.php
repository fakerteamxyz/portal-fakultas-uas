@extends('layouts.mahasiswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <!-- Back button -->
            <a href="{{ route('mahasiswa.informasi.index') }}" class="btn btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke daftar informasi
            </a>
            
            <!-- Informasi Card -->
            <div class="card shadow-sm mb-4">
                @if($informasi->gambar)
                    <img src="{{ asset($informasi->gambar) }}" class="card-img-top" alt="{{ $informasi->judul }}" style="max-height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-body">
                    <h2 class="card-title text-primary">{{ $informasi->judul }}</h2>
                    
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-primary">{{ $informasi->created_at->format('d M Y') }}</span>
                        @if($informasi->user && $informasi->user->role === 'admin')
                            <span class="badge bg-danger">
                                <i class="bi bi-broadcast me-1"></i> Admin
                            </span>
                        @endif
                        @if($informasi->agenda)
                            <span class="badge bg-info text-dark">
                                <i class="bi bi-calendar-event me-1"></i> {{ $informasi->agenda->judul }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary text-white rounded-circle p-2 text-center me-2" style="width: 40px; height: 40px;">
                            {{ substr($informasi->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="fw-bold">{{ $informasi->user->name }}</div>
                            <div class="text-muted small">{{ $informasi->user->role }}</div>
                        </div>
                    </div>
                    
                    <div class="card-text mb-4">
                        {{ $informasi->konten }}
                    </div>
                </div>
            </div>
            
            <!-- Comments Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Komentar ({{ $informasi->comments->count() }})</h5>
                </div>
                <div class="card-body">
                    <!-- Comment Form -->
                    <form action="{{ route('mahasiswa.komentar.store') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="informasi_id" value="{{ $informasi->id }}">
                        <div class="mb-3">
                            <label for="reply-isi" class="form-label">Tinggalkan komentar Anda</label>
                            <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="reply-isi" rows="3" required></textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-1"></i> Kirim Komentar
                        </button>
                    </form>
                    
                    <hr>
                    
                    <!-- Comments List -->
                    @if($informasi->comments->count() > 0)
                        @foreach($informasi->comments as $komentar)
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle p-2 text-center me-2" style="width: 40px; height: 40px;">
                                                {{ substr($komentar->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $komentar->user->name }}</div>
                                                <div class="text-muted small">{{ $komentar->created_at->format('d M Y, H:i') }}</div>
                                            </div>
                                        </div>
                                        
                                        @if($komentar->user_id === auth()->id())
                                            <form action="{{ route('mahasiswa.komentar.destroy', $komentar->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?\n\nKomentar yang dihapus tidak dapat dikembalikan.')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    
                                    <p class="mb-2">{{ $komentar->isi }}</p>
                                    
                                    <!-- Reply button for students -->
                                    <button class="btn btn-sm btn-outline-primary mb-2" data-bs-toggle="collapse" href="#reply-form-{{ $komentar->id }}" role="button" aria-expanded="false">
                                        <i class="bi bi-reply"></i> Balas
                                    </button>
                                    
                                    <div class="collapse mt-2 mb-3" id="reply-form-{{ $komentar->id }}">
                                        <form action="{{ route('mahasiswa.komentar.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="informasi_id" value="{{ $informasi->id }}">
                                            <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                                            <div class="mb-2">
                                                <textarea class="form-control" name="isi" rows="2" placeholder="Tulis balasan Anda..." required></textarea>
                                                <small class="text-muted">Balasan Anda akan dapat dilihat oleh admin dan mahasiswa lain.</small>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-send"></i> Kirim Balasan
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#reply-form-{{ $komentar->id }}">
                                                <i class="bi bi-x"></i> Batal
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <!-- Replies to this comment -->
                                    @if($komentar->replies->count() > 0)
                                        <div class="ms-4 mt-3">
                                            @foreach($komentar->replies as $reply)
                                                <div class="card mb-2 bg-light {{ $reply->user->role === 'admin' ? 'border-start border-danger border-3' : '' }}">
                                                    <div class="card-body py-2">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <div class="d-flex align-items-center">
                                                                <div class="{{ $reply->user->role === 'admin' ? 'bg-danger' : 'bg-primary' }} text-white rounded-circle p-1 text-center me-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                                    {{ substr($reply->user->name, 0, 1) }}
                                                                </div>
                                                                <div>
                                                                    <div class="fw-bold">{{ $reply->user->name }} 
                                                                        @if($reply->user->role === 'admin')
                                                                            <span class="badge bg-danger">Admin</span>
                                                                        @endif
                                                                        @if($reply->created_at->diffInHours(now()) < 24 && $reply->user->role === 'admin')
                                                                            <span class="badge bg-warning text-dark">Baru</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="text-muted small">{{ $reply->created_at->format('d M Y, H:i') }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0">{{ $reply->isi }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-chat-left-text display-4 text-muted"></i>
                            <p class="mt-2">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Related Information -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informasi Terkait</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach(App\Models\Informasi::where('id', '!=', $informasi->id)
                            ->where('is_published', 1)
                            ->latest()
                            ->take(5)
                            ->get() as $related)
                            <a href="{{ route('mahasiswa.informasi.show', $related->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $related->judul }}</h6>
                                    <small class="text-muted">{{ $related->created_at->format('d M Y') }}</small>
                                </div>
                                <p class="mb-1 text-muted small">{{ Str::limit($related->konten, 50) }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection