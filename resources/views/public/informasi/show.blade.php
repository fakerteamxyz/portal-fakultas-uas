<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $informasi->judul }} - Portal Fakultas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff5252;
            --secondary: #ffde59;
            --accent: #4aff8b;
            --dark: #121212;
            --light: #f5f5f5;
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            position: relative;
            overflow-x: hidden;
        }
        
        .neo-card {
            border: 5px solid var(--dark);
            box-shadow: 8px 8px 0px var(--dark);
            padding: 1.5rem;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }
        
        .neo-btn {
            border: 3px solid var(--dark);
            box-shadow: 4px 4px 0px var(--dark);
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-block;
            text-decoration: none;
            color: var(--dark);
        }
        
        .neo-btn:hover {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px var(--dark);
        }
        
        .fw-black {
            font-weight: 900;
        }
        
        .neo-page-header {
            background-color: var(--accent);
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-bottom: 5px solid var(--dark);
            position: relative;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="neo-page-header position-relative">
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
                <a href="{{ url('/') }}" class="neo-btn mb-4" style="background-color: white; display: inline-flex; align-items: center;">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke halaman utama
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
                    
                    <div style="padding: 2rem;">
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge" style="background-color: var(--primary); font-size: 0.9rem; border: 2px solid var(--dark); border-radius: 0;">
                                <i class="bi bi-calendar me-1"></i> {{ $informasi->created_at->format('d M Y') }}
                            </span>
                            
                            @if($informasi->user && $informasi->user->role === 'admin')
                                <span class="badge" style="background-color: var(--dark); font-size: 0.9rem; border: 2px solid var(--dark); border-radius: 0;">
                                    <i class="bi bi-person-badge-fill me-1"></i> Admin
                                </span>
                            @elseif($informasi->user && $informasi->user->role === 'dosen')
                                <span class="badge" style="background-color: var(--secondary); color: var(--dark); font-size: 0.9rem; border: 2px solid var(--dark); border-radius: 0;">
                                    <i class="bi bi-mortarboard-fill me-1"></i> Dosen
                                </span>
                            @endif
                            
                            @if($informasi->agenda)
                                <span class="badge" style="background-color: var(--accent); color: var(--dark); font-size: 0.9rem; border: 2px solid var(--dark); border-radius: 0;">
                                    <i class="bi bi-calendar-event me-1"></i> Agenda: {{ $informasi->agenda->judul }}
                                </span>
                            @endif
                        </div>
                        
                        <h2 class="display-6 fw-bold mb-4" style="letter-spacing: -0.5px;">{{ $informasi->judul }}</h2>
                        
                        <div class="neo-card mb-4 p-3" style="border: 3px dashed var(--dark); background-color: rgba(255,255,255,0.8);">
                            <div class="d-flex align-items-center mb-3">
                                <div style="width: 50px; height: 50px; border-radius: 50%; border: 3px solid var(--dark); background-color: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: bold;">
                                    {{ substr($informasi->user->name, 0, 1) }}
                                </div>
                                <div class="ms-3">
                                    <div class="fw-bold">{{ $informasi->user->name }}</div>
                                    <div class="text-muted" style="font-size: 0.9rem;">{{ ucfirst($informasi->user->role) }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="content mb-4" style="line-height: 1.7; font-size: 1.05rem;">
                            {!! nl2br(e($informasi->konten)) !!}
                        </div>
                        
                        @if($informasi->file_path)
                        <div class="neo-card mb-4 p-4" style="border: 4px dashed var(--dark); background-color: rgba(255,255,255,0.8); position: relative;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-bold mb-2">File Lampiran</h5>
                                    <p class="mb-0">{{ $informasi->file_name ?: basename($informasi->file_path) }}</p>
                                </div>
                                @auth
                                <a href="{{ route('mahasiswa.informasi.download', $informasi->id) }}" class="neo-btn" style="background-color: var(--primary); color: white;">
                                    <i class="bi bi-download me-2"></i> Download
                                </a>
                                @else
                                <a href="{{ route('login') }}" class="neo-btn" style="background-color: var(--primary); color: white;">
                                    <i class="bi bi-lock me-2"></i> Login untuk Download
                                </a>
                                @endauth
                            </div>
                        </div>
                        @endif
                        
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ url('/') }}" class="neo-btn" style="background-color: var(--secondary);">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>
                            </div>
                            @auth
                            <div>
                                <a href="{{ auth()->user()->role === 'mahasiswa' ? route('mahasiswa.informasi.index') : (auth()->user()->role === 'admin' ? route('admin.informasi.index') : (auth()->user()->role === 'dosen' ? route('dosen.informasi.index') : '#')) }}" class="neo-btn" style="background-color: var(--accent);">
                                    <i class="bi bi-grid me-2"></i> Dashboard
                                </a>
                            </div>
                            @else
                            <div>
                                <a href="{{ route('login') }}" class="neo-btn" style="background-color: var(--primary); color: white;">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> Login
                                </a>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- More Information -->
                <div class="neo-card" style="background-color: white;">
                    <h5 class="fw-bold mb-4">Informasi Lainnya</h5>
                    
                    @php
                        $otherInformasi = \App\Models\Informasi::where('id', '!=', $informasi->id)
                            ->where('is_published', 1)
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp
                    
                    @if($otherInformasi->count() > 0)
                        <div class="list-group list-group-flush" style="margin: 0 -1.5rem -1.5rem -1.5rem;">
                            @foreach($otherInformasi as $other)
                                <a href="{{ route('public.informasi.show', $other->id) }}" class="list-group-item list-group-item-action" style="border-left: 0; border-right: 0; border-bottom-width: 2px; border-color: #e0e0e0;">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0 fw-bold">{{ $other->judul }}</h6>
                                        <small>{{ $other->created_at->format('d M Y') }}</small>
                                    </div>
                                    <p class="mb-0 text-muted" style="font-size: 0.9rem;">{{ Str::limit($other->konten, 80) }}</p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Belum ada informasi lainnya.</p>
                    @endif
                </div>

                @if($informasi->agenda)
                <!-- Related Agenda Card -->
                <div class="neo-card mt-4" style="background-color: var(--secondary);">
                    <h5 class="fw-bold mb-3">Agenda Terkait</h5>
                    <h6 class="fw-bold">{{ $informasi->agenda->judul }}</h6>
                    
                    <div class="mb-3 p-2" style="background-color: white; border: 2px solid var(--dark); margin-top: 1rem;">
                        <i class="bi bi-calendar-check me-2"></i> {{ \Carbon\Carbon::parse($informasi->agenda->tanggal)->format('d M Y, H:i') }}
                    </div>
                    
                    <p style="font-size: 0.95rem;">{{ Str::limit($informasi->agenda->deskripsi, 150) }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <footer class="text-center py-5 mt-5" style="background-color:var(--dark); color:white; position:relative; overflow:hidden;">
        <div style="position:absolute; width:100px; height:100px; background:var(--primary); border:4px solid white; transform:rotate(45deg); top:-50px; right:10%;"></div>
        <div style="position:absolute; width:80px; height:80px; background:var(--accent); border:4px solid white; transform:rotate(15deg); bottom:-30px; left:15%;"></div>
        <div style="position:absolute; width:120px; height:120px; background:var(--secondary); border:4px solid white; transform:rotate(25deg); bottom:-60px; right:20%;"></div>
        
        <div class="container position-relative">
            <div style="background:white; display:inline-block; border:4px solid white; padding:0.5rem; margin-bottom:1rem; transform:rotate(-2deg);">
                <img src="{{ asset('sb-admin-2/img/logo.png') }}" alt="Logo" style="height:48px;">
            </div>
            <div>
                <h3 class="fw-bold mb-3" style="font-size:2rem; text-transform:uppercase; letter-spacing:2px;">Portal Fakultas</h3>
                <p class="mb-3">Membantu civitas akademika mengakses informasi dan layanan dengan mudah</p>
                <div style="display:flex; justify-content:center; gap:1rem; margin-top:2rem; margin-bottom:1.5rem;">
                    <a href="#" style="color:white; font-size:1.5rem;"><i class="bi bi-facebook"></i></a>
                    <a href="#" style="color:white; font-size:1.5rem;"><i class="bi bi-instagram"></i></a>
                    <a href="#" style="color:white; font-size:1.5rem;"><i class="bi bi-twitter"></i></a>
                    <a href="#" style="color:white; font-size:1.5rem;"><i class="bi bi-youtube"></i></a>
                </div>
                <div style="border-top:1px solid rgba(255,255,255,0.2); padding-top:1.5rem; margin-top:1.5rem;">
                    <span class="fw-bold">&copy; {{ date('Y') }} Fakultas Teknik</span> - Universitas Negeri Padang
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
