@extends('layouts.dosen')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Informasi</h1>
        <a href="{{ url('/') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali ke Portal
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Informasi Card -->
            <div class="card shadow mb-4">
                @if($informasi->gambar)
                    <img src="{{ asset($informasi->gambar) }}" class="card-img-top" alt="{{ $informasi->judul }}" style="max-height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $informasi->judul }}</h6>
                </div>
                
                <div class="card-body">                    
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge badge-primary">{{ $informasi->created_at->format('d M Y') }}</span>
                        @if($informasi->user && $informasi->user->role === 'admin')
                            <span class="badge badge-danger">
                                <i class="fas fa-broadcast-tower mr-1"></i> Admin
                            </span>
                        @elseif($informasi->user && $informasi->user->role === 'dosen')
                            <span class="badge badge-success">
                                <i class="fas fa-user-tie mr-1"></i> Dosen
                            </span>
                        @endif
                        @if($informasi->agenda)
                            <span class="badge badge-info">
                                <i class="fas fa-calendar-alt mr-1"></i> {{ $informasi->agenda->judul }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary text-white rounded-circle p-2 text-center mr-2" style="width: 40px; height: 40px;">
                            {{ substr($informasi->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-weight-bold">{{ $informasi->user->name }}</div>
                            <div class="text-muted small">{{ ucfirst($informasi->user->role) }}</div>
                        </div>
                    </div>
                    
                    <div class="card-text mb-4">
                        {{ $informasi->konten }}
                    </div>
                </div>
            </div>
            
            <!-- Comments Section -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Komentar ({{ $informasi->comments->count() }})</h6>
                </div>
                <div class="card-body">
                    @if($informasi->comments->count() > 0)
                        @foreach($informasi->comments as $komentar)
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="{{ $komentar->user->role === 'mahasiswa' ? 'bg-light' : ($komentar->user->role === 'admin' ? 'bg-danger' : 'bg-primary') }} {{ $komentar->user->role !== 'mahasiswa' ? 'text-white' : '' }} rounded-circle p-2 text-center mr-2" style="width: 40px; height: 40px;">
                                                {{ substr($komentar->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-weight-bold">{{ $komentar->user->name }}</div>
                                                <div class="text-muted small">{{ $komentar->created_at->format('d M Y, H:i') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <p class="mb-2">{{ $komentar->isi }}</p>
                                    
                                    <!-- Reply button for dosen -->
                                    <button class="btn btn-sm btn-outline-primary mb-2" data-toggle="collapse" href="#reply-form-{{ $komentar->id }}" role="button" aria-expanded="false">
                                        <i class="fas fa-reply"></i> Balas
                                    </button>
                                    
                                    <div class="collapse mt-2 mb-3" id="reply-form-{{ $komentar->id }}">
                                        <form action="{{ route('dosen.komentar.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="informasi_id" value="{{ $informasi->id }}">
                                            <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                                            <div class="mb-2">
                                                <textarea class="form-control" name="isi" rows="2" placeholder="Tulis balasan Anda..." required></textarea>
                                                <small class="text-muted">Balasan Anda akan dapat dilihat oleh mahasiswa dan admin.</small>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fas fa-paper-plane"></i> Kirim Balasan
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="collapse" data-target="#reply-form-{{ $komentar->id }}">
                                                <i class="fas fa-times"></i> Batal
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <!-- Replies to this comment -->
                                    @if($komentar->replies->count() > 0)
                                        <div class="ml-4 mt-3">
                                            @foreach($komentar->replies as $reply)
                                                <div class="card mb-2 {{ $reply->user->role === 'admin' ? 'border-left border-danger' : ($reply->user->role === 'dosen' ? 'border-left border-primary' : '') }} {{ $reply->user->role !== 'mahasiswa' ? 'border-3' : '' }}">
                                                    <div class="card-body py-2">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <div class="d-flex align-items-center">
                                                                <div class="{{ $reply->user->role === 'admin' ? 'bg-danger' : ($reply->user->role === 'dosen' ? 'bg-primary' : 'bg-light') }} {{ $reply->user->role !== 'mahasiswa' ? 'text-white' : '' }} rounded-circle p-1 text-center mr-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                                    {{ substr($reply->user->name, 0, 1) }}
                                                                </div>
                                                                <div>
                                                                    <div class="font-weight-bold">{{ $reply->user->name }} 
                                                                        @if($reply->user->role === 'admin')
                                                                            <span class="badge badge-danger">Admin</span>
                                                                        @elseif($reply->user->role === 'dosen')
                                                                            <span class="badge badge-primary">Dosen</span>
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
                            <i class="fas fa-comments display-4 text-muted"></i>
                            <p class="mt-2">Belum ada komentar.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Related Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Terkait</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach(App\Models\Informasi::where('id', '!=', $informasi->id)
                            ->where('is_published', 1)
                            ->latest()
                            ->take(5)
                            ->get() as $related)
                            <a href="{{ route('dosen.view.informasi', $related->id) }}" class="list-group-item list-group-item-action">
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
            
            @if($informasi->agenda)
            <!-- Related Agenda -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Agenda Terkait</h6>
                </div>
                <div class="card-body">
                    <h5>{{ $informasi->agenda->judul }}</h5>
                    <p class="mb-2">{{ \Carbon\Carbon::parse($informasi->agenda->tanggal)->format('d M Y, H:i') }}</p>
                    <p>{{ Str::limit($informasi->agenda->deskripsi, 150) }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
