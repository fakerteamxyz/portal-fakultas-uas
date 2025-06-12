@extends('layouts.mahasiswa')

@section('content')
<div class="neo-page-header position-relative" style="background-color: var(--accent); padding: 3rem 0; overflow: hidden;">
    <!-- Neobrutalism geometric decorations -->
    <div class="position-absolute" style="width: 80px; height: 80px; background-color: var(--secondary); border: 5px solid var(--dark); transform: rotate(15deg); top: 20px; left: 10%;"></div>
    <div class="position-absolute" style="width: 120px; height: 120px; background-color: var(--primary); border: 5px solid var(--dark); transform: rotate(30deg); top: -30px; right: 15%;"></div>
    <div class="position-absolute" style="width: 60px; height: 60px; background-color: white; border: 5px solid var(--dark); transform: rotate(-10deg); bottom: 20px; left: 20%;"></div>
    
    <div class="container position-relative">
        <h1 class="fw-black text-uppercase" style="font-size: 2.5rem; letter-spacing: 2px; text-shadow: 4px 4px 0 var(--dark);">Detail Informasi</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Back button -->
            <a href="{{ route('mahasiswa.informasi.index') }}" class="neo-btn mb-4" style="background-color: white; display: inline-flex; align-items: center;">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke daftar informasi
            </a>
            
            <!-- Informasi Card -->
            <div class="neo-card mb-5" style="overflow: hidden; position: relative; background-color: white;">
                @if($informasi->gambar)
                    <div style="position: relative; overflow: hidden;">
                        <img src="{{ asset($informasi->gambar) }}" alt="{{ $informasi->judul }}" 
                             style="max-height: 400px; object-fit: cover; width: 100%; border-bottom: 6px solid var(--dark);">
                        <div class="position-absolute bottom-0 end-0 p-2" style="background-color: var(--secondary); border-top: 4px solid var(--dark); border-left: 4px solid var(--dark);">
                            <span class="fw-black text-uppercase" style="color: var(--dark); letter-spacing: 1px; font-size: 0.9rem;">
                                <i class="bi bi-camera me-1"></i> Gambar Ilustrasi
                            </span>
                        </div>
                    </div>
                @endif
                
                <div class="card-body p-4">
                    <h2 class="fw-black mb-3" style="text-transform: uppercase; letter-spacing: 1px; color: var(--dark); font-size: 2rem; text-shadow: 2px 2px 0 rgba(0,0,0,0.1);">{{ $informasi->judul }}</h2>
                    
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="neo-badge" style="transform: rotate(-2deg);">{{ $informasi->created_at->format('d M Y') }}</span>
                        @if($informasi->user && $informasi->user->role === 'admin')
                            <span class="neo-badge" style="background-color: var(--primary); color: white; transform: rotate(1deg);">
                                <i class="bi bi-broadcast me-1"></i> Admin
                            </span>
                        @elseif($informasi->user && $informasi->user->role === 'dosen')
                            <span class="neo-badge" style="background-color: var(--accent); color: var(--dark); transform: rotate(1deg);">
                                <i class="bi bi-person-badge me-1"></i> Info Dosen
                            </span>
                        @endif
                        @if($informasi->agenda)
                            <span class="neo-badge" style="background-color: var(--secondary); color: var(--dark); transform: rotate(-1deg);">
                                <i class="bi bi-calendar-event me-1"></i> {{ $informasi->agenda->judul }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="d-flex align-items-center mb-4 p-3" style="border: 4px solid var(--dark); background-color: var(--light); transform: rotate(-1deg);">
                        <div class="text-center me-3" style="width: 60px; height: 60px; border: 4px solid var(--dark); background-color: var(--primary); color: white; display: flex; align-items: center; justify-content: center; transform: rotate(-3deg); box-shadow: 4px 4px 0 var(--dark);">
                            <span style="font-weight: 900; font-size: 1.8rem;">{{ substr($informasi->user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <div class="fw-black" style="font-size: 1.2rem; text-transform: uppercase; letter-spacing: 0.5px;">{{ $informasi->user->name }}</div>
                            <div class="text-uppercase" style="font-weight: 700; color: var(--primary); letter-spacing: 1px;">{{ $informasi->user->role }}</div>
                        </div>
                    </div>
                    
                    <div class="neo-content mb-4 p-4" style="border: 4px solid var(--dark); background-color: var(--light); font-size: 1.1rem; line-height: 1.7; box-shadow: 8px 8px 0 var(--dark); position: relative;">
                        {{ $informasi->konten }}
                        <!-- Decorative element at bottom right -->
                        <div class="position-absolute" style="width: 30px; height: 30px; background-color: var(--secondary); border: 3px solid var(--dark); right: -12px; bottom: -12px; transform: rotate(15deg);"></div>
                    </div>
                </div>
            </div>
            
            <!-- Comments Section -->
            <div class="neo-card mb-5" style="position: relative;">
                <div class="position-absolute" style="width: 40px; height: 40px; background-color: var(--primary); border: 3px solid var(--dark); top: -15px; right: 40px; transform: rotate(12deg);"></div>
                
                <div class="neo-card-header py-3" style="background-color: var(--secondary); border-bottom: 6px solid var(--dark);">
                    <h5 class="m-0 fw-black" style="text-transform: uppercase; letter-spacing: 1px; font-size: 1.4rem; display: flex; align-items: center;">
                        <i class="bi bi-chat-square-text me-2" style="font-size: 1.5rem;"></i>
                        Komentar <span class="ms-2 neo-badge" style="background-color: white; transform: translateY(-2px);">{{ $informasi->comments->count() }}</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <!-- Comment Form -->
                    <form action="{{ route('mahasiswa.komentar.store') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="informasi_id" value="{{ $informasi->id }}">
                        <div class="mb-3">
                            <label for="reply-isi" class="form-label fw-bold" style="text-transform: uppercase; letter-spacing: 1px; font-size: 1.1rem;">
                                Tinggalkan komentar Anda
                            </label>
                            <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="reply-isi" 
                                rows="3" required style="border: 4px solid var(--dark); border-radius: 0; padding: 12px 15px; font-size: 1.05rem; box-shadow: 4px 4px 0 rgba(0,0,0,0.1);"></textarea>
                            @error('isi')
                                <div class="invalid-feedback" style="font-weight: 700; color: var(--primary);">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="neo-btn neo-btn-primary" style="display: flex; align-items: center; gap: 8px; font-size: 1rem;">
                            <i class="bi bi-send"></i> Kirim Komentar
                        </button>
                    </form>
                    
                    <hr style="border-top: 4px dashed var(--dark); opacity: 1; margin: 2rem 0;">
                    
                    <!-- Comments List -->
                    @if($informasi->comments->count() > 0)
                        @foreach($informasi->comments as $komentar)
                            <div class="mb-4 position-relative" style="border: 4px solid var(--dark); box-shadow: 8px 8px 0 var(--dark); background-color: white;">
                                <!-- Decorative element -->
                                <div class="position-absolute" style="width: 20px; height: 20px; background-color: var(--secondary); border: 2px solid var(--dark); top: -10px; right: -10px; transform: rotate(15deg);"></div>
                                
                                <div class="p-3" style="border-bottom: 0;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="text-center me-3" style="width: 50px; height: 50px; border: 3px solid var(--dark); background-color: var(--secondary); color: var(--dark); display: flex; align-items: center; justify-content: center; transform: rotate(-3deg); box-shadow: 3px 3px 0 var(--dark);">
                                                <span style="font-weight: 900; font-size: 1.4rem;">{{ substr($komentar->user->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="fw-black" style="font-size: 1.2rem; letter-spacing: 0.5px;">{{ $komentar->user->name }}</div>
                                                <div style="font-weight: 600; color: var(--primary); display: flex; align-items: center; gap: 5px;">
                                                    <i class="bi bi-clock"></i>
                                                    {{ $komentar->created_at->format('d M Y, H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($komentar->user_id === auth()->id())
                                            <form action="{{ route('mahasiswa.komentar.destroy', $komentar->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="neo-btn" style="background-color: var(--primary); color: white; font-size: 0.9rem; padding: 8px 12px; border-width: 3px; box-shadow: 4px 4px 0 var(--dark);" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?\n\nKomentar yang dihapus tidak dapat dikembalikan.')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    
                                    <div class="p-3 mb-3" style="border: 2px solid var(--dark); background-color: var(--light); font-size: 1.05rem; line-height: 1.6;">
                                        {{ $komentar->isi }}
                                    </div>
                                    
                                    <!-- Reply button for students -->
                                    <button class="neo-btn" style="background-color: var(--accent); color: var(--dark); font-size: 0.95rem; padding: 6px 14px; display: flex; align-items: center; gap: 5px; border-width: 3px; box-shadow: 4px 4px 0 var(--dark);" data-bs-toggle="collapse" href="#reply-form-{{ $komentar->id }}" role="button" aria-expanded="false">
                                        <i class="bi bi-reply"></i> Balas
                                    </button>
                                    
                                    <div class="collapse mt-3 mb-3" id="reply-form-{{ $komentar->id }}">
                                        <form action="{{ route('mahasiswa.komentar.store') }}" method="POST" class="p-3" style="border: 3px dashed var(--dark); background-color: var(--light);">
                                            @csrf
                                            <input type="hidden" name="informasi_id" value="{{ $informasi->id }}">
                                            <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                                            <div class="mb-3">
                                                <textarea class="form-control" name="isi" rows="2" placeholder="Tulis balasan Anda..." required
                                                    style="border: 3px solid var(--dark); border-radius: 0; padding: 10px;"></textarea>
                                                <small style="font-weight: 700; color: var(--primary); display: block; margin-top: 5px; letter-spacing: 0.5px;">
                                                    <i class="bi bi-info-circle me-1"></i> Balasan Anda akan dapat dilihat oleh admin dan mahasiswa lain.
                                                </small>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="neo-btn" style="background-color: var(--accent); font-size: 0.9rem; padding: 5px 12px; display: flex; align-items: center; gap: 5px; border-width: 3px; box-shadow: 3px 3px 0 var(--dark);">
                                                    <i class="bi bi-send"></i> Kirim Balasan
                                                </button>
                                                <button type="button" class="neo-btn" style="background-color: white; font-size: 0.9rem; padding: 5px 12px; display: flex; align-items: center; gap: 5px; border-width: 3px; box-shadow: 3px 3px 0 var(--dark);" 
                                                    data-bs-toggle="collapse" data-bs-target="#reply-form-{{ $komentar->id }}">
                                                    <i class="bi bi-x"></i> Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <!-- Replies to this comment -->
                                    @if($komentar->replies->count() > 0)
                                        <div class="mt-4 ms-4 ps-4 position-relative" style="border-left: 4px dashed var(--dark);">
                                            <!-- Vertical decorative element -->
                                            <div class="position-absolute" style="width: 15px; height: 15px; background-color: var(--accent); border: 2px solid var(--dark); left: -10px; top: -15px; transform: rotate(20deg);"></div>
                                            <div class="position-absolute" style="width: 15px; height: 15px; background-color: var(--primary); border: 2px solid var(--dark); left: -10px; bottom: -10px; transform: rotate(-15deg);"></div>
                                            
                                            <h6 class="fw-black mb-3" style="text-transform: uppercase; letter-spacing: 0.5px;">Balasan <span class="neo-badge" style="font-size: 0.8rem; transform: translateY(-2px);">{{ $komentar->replies->count() }}</span></h6>
                                            
                                            @foreach($komentar->replies as $reply)
                                                <div class="mb-3 position-relative" style="border: 3px solid var(--dark); 
                                                    @if($reply->user->role === 'admin')
                                                        border-left-color: var(--primary); border-left-width: 8px;
                                                        background-color: rgba(255, 82, 82, 0.05);
                                                    @else
                                                        background-color: white;
                                                    @endif
                                                    box-shadow: 5px 5px 0 var(--dark);
                                                ">
                                                    <div class="p-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <div class="d-flex align-items-center">
                                                                <div class="text-center me-2" 
                                                                    style="width: 38px; height: 38px; border: 2px solid var(--dark); 
                                                                    @if($reply->user->role === 'admin')
                                                                        background-color: var(--primary); color: white;
                                                                    @else
                                                                        background-color: var(--accent); color: var(--dark);
                                                                    @endif
                                                                    display: flex; align-items: center; justify-content: center; transform: rotate(-3deg); box-shadow: 2px 2px 0 var(--dark);">
                                                                    <span style="font-weight: 900; font-size: 1.1rem;">{{ substr($reply->user->name, 0, 1) }}</span>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-bold">{{ $reply->user->name }} 
                                                                        @if($reply->user->role === 'admin')
                                                                            <span class="neo-badge" style="background-color: var(--primary); color: white; font-size: 0.8rem; transform: translateY(-2px);">Admin</span>
                                                                        @endif
                                                                        @if($reply->created_at->diffInHours(now()) < 24 && $reply->user->role === 'admin')
                                                                            <span class="neo-badge" style="background-color: var(--secondary); color: var(--dark); font-size: 0.8rem; transform: translateY(-2px);">Baru</span>
                                                                        @endif
                                                                    </div>
                                                                    <div style="font-weight: 600; color: var(--primary); font-size: 0.85rem; display: flex; align-items: center; gap: 3px;">
                                                                        <i class="bi bi-clock"></i> {{ $reply->created_at->format('d M Y, H:i') }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            @if($reply->user_id === auth()->id())
                                                                <form action="{{ route('mahasiswa.komentar.destroy', $reply->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="neo-btn" style="background-color: var(--primary); color: white; font-size: 0.75rem; padding: 5px 10px; border-width: 2px; box-shadow: 3px 3px 0 var(--dark);" onclick="return confirm('Apakah Anda yakin ingin menghapus balasan ini?')">
                                                                        <i class="bi bi-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                        <p class="mb-0 p-2" style="font-size: 1rem; border: 1px solid rgba(0,0,0,0.1);">{{ $reply->isi }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5 position-relative" style="border: 4px dashed var(--dark); background-color: var(--light);">
                            <!-- Decorative elements -->
                            <div class="position-absolute" style="width: 30px; height: 30px; background-color: var(--secondary); border: 3px solid var(--dark); top: -15px; left: 30px; transform: rotate(20deg);"></div>
                            <div class="position-absolute" style="width: 30px; height: 30px; background-color: var(--primary); border: 3px solid var(--dark); top: 20px; right: -15px; transform: rotate(-15deg);"></div>
                            
                            <i class="bi bi-chat-left-text display-4" style="color: var(--primary);"></i>
                            <p class="mt-3 fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px; text-transform: uppercase;">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Related Information -->
            <div class="neo-card mb-4 position-relative" style="transform: rotate(1deg);">
                <!-- Decorative elements -->
                <div class="position-absolute" style="width: 30px; height: 30px; background-color: var(--primary); border: 3px solid var(--dark); top: -15px; right: 20px; transform: rotate(15deg);"></div>
                
                <div class="neo-card-header py-3" style="background-color: var(--accent); border-bottom-width: 5px;">
                    <h5 class="m-0 fw-black" style="text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center;">
                        <i class="bi bi-grid-3x3-gap me-2"></i> Informasi Terkait
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach(App\Models\Informasi::where('id', '!=', $informasi->id)
                            ->where('is_published', 1)
                            ->latest()
                            ->take(5)
                            ->get() as $related)
                            <a href="{{ route('mahasiswa.informasi.show', $related->id) }}" 
                               class="list-group-item list-group-item-action border-bottom border-3 p-3"
                               style="transition: all 0.3s ease; border-color: var(--dark) !important;">
                                <div class="d-flex w-100 justify-content-between align-items-start">
                                    <h6 class="mb-1 fw-bold" style="color: var(--dark); text-transform: uppercase; letter-spacing: 0.5px;">
                                        {{ Str::limit($related->judul, 30) }}
                                    </h6>
                                    <span class="neo-badge" style="font-size: 0.7rem; transform: rotate(2deg);">{{ $related->created_at->format('d M Y') }}</span>
                                </div>
                                <p class="mb-1 small" style="color: #555;">{{ Str::limit($related->konten, 50) }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-center py-3" style="border-top: 5px solid var(--dark); background-color: var(--light);">
                    <a href="{{ route('mahasiswa.informasi.index') }}" class="neo-btn" style="background-color: var(--accent); color: var(--dark); font-size: 0.95rem; padding: 8px 16px; display: inline-flex; align-items: center; gap: 6px; border-width: 3px; box-shadow: 4px 4px 0 var(--dark); text-transform: uppercase; font-weight: 700;">
                        <i class="bi bi-grid"></i> Lihat Semua Informasi
                    </a>
                </div>
            </div>
            
            <!-- Additional Neo Card for Stats or Featured Content -->
            <div class="neo-card mb-4" style="background-color: var(--primary); color: white; transform: rotate(-1deg);">
                <div class="card-body p-4 text-center">
                    <h5 class="fw-black text-uppercase mb-3" style="letter-spacing: 1px; text-shadow: 2px 2px 0 rgba(0,0,0,0.3);">Portal Fakultas</h5>
                    
                    <div class="mb-3 mt-4">
                        <div style="font-size: 2.5rem; font-weight: 900; margin-bottom: 0.2rem;">{{ App\Models\Informasi::count() }}</div>
                        <div style="text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Total Informasi</div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('mahasiswa.landing') }}" class="neo-btn" style="background-color: white; color: var(--dark); border-width: 3px; box-shadow: 4px 4px 0 var(--dark); display: inline-flex; align-items: center; gap: 5px;">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links Neo Card -->
            <div class="neo-card" style="transform: rotate(1deg); background-color: var(--secondary);">
                <div class="neo-card-header py-3" style="background-color: var(--dark); color: white; border-bottom-width: 5px;">
                    <h5 class="m-0 fw-black" style="text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center;">
                        <i class="bi bi-link-45deg me-2"></i> Tautan Cepat
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('mahasiswa.agenda') }}" class="neo-btn" style="background-color: white; display: flex; align-items: center; gap: 8px; border-width: 3px; box-shadow: 4px 4px 0 var(--dark);">
                            <i class="bi bi-calendar3"></i> Agenda Fakultas
                        </a>
                        <a href="{{ route('profile.edit') }}" class="neo-btn" style="background-color: var(--light); display: flex; align-items: center; gap: 8px; border-width: 3px; box-shadow: 4px 4px 0 var(--dark);">
                            <i class="bi bi-person-circle"></i> Profil Saya
                        </a>
                        <a href="https://example.edu/elearning" target="_blank" class="neo-btn" style="background-color: var(--accent); display: flex; align-items: center; gap: 8px; border-width: 3px; box-shadow: 4px 4px 0 var(--dark);">
                            <i class="bi bi-laptop"></i> E-Learning
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection