<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Fakultas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .hero {
            background: linear-gradient(120deg, #4e73df 60%, #36b9cc 100%);
            color: #fff;
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            position: relative;
        }
        .hero .btn {
            font-size: 1.2rem;
            padding: 0.75rem 2rem;
        }
        .info-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .info-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 8px 32px rgba(78,115,223,0.15);
        }
        .slider-img {
            object-fit: cover;
            height: 350px;
            border-radius: 1rem;
        }
        .fade-in {
            animation: fadeIn 1.2s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: none; }
        }
        .nav-pills .nav-link:hover {
            background-color: rgba(78, 115, 223, 0.1);
            color: #4e73df !important;
        }
        .nav-pills .nav-link.active {
            background-color: #4e73df;
            color: white !important;
        }
        
        /* Navbar and dropdown styling */
        .navbar-nav .nav-link {
            color: #4e73df !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #2e59d9 !important;
            transform: translateY(-2px);
        }
        .dropdown-menu {
            border: none;
            border-radius: 0.5rem;
        }
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: all 0.2s ease;
        }
        .dropdown-item:hover {
            background-color: rgba(78, 115, 223, 0.1);
            color: #4e73df;
            transform: translateX(5px);
        }
        .dropdown-divider {
            margin: 0.3rem 0;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                border-radius: 0.5rem;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                margin-top: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="#">
                <img src="{{ asset('image/logounp.png') }}" alt="Logo" style="height:40px;"> 
                <span class="ms-2">Portal Informasi Fakultas Teknik</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#informasi">Informasi</a></li>
                    
                    <!-- Dropdown Agenda -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarAgendaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Agenda
                        </a>
                        <ul class="dropdown-menu shadow" aria-labelledby="navbarAgendaDropdown">
                            <li><a class="dropdown-item" href="#agenda">Semua Agenda</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach($kategoriAgendas as $kategori)
                            <li><a class="dropdown-item" href="#agenda-{{ $kategori->id }}">{{ $kategori->nama }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    
                    <!-- Dropdown Informasi -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarInfoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Layanan
                        </a>
                        <ul class="dropdown-menu shadow" aria-labelledby="navbarInfoDropdown">
                            <li><a class="dropdown-item" href="#berita">Berita</a></li>
                            <li><a class="dropdown-item" href="#mingguan">Mingguan</a></li>
                            <li><a class="dropdown-item" href="#kunjungan">Kunjungan Mahasiswa</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item"><a class="nav-link" href="#kemahasiswaan">Kemahasiswaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                </ul>
                <div class="d-flex gap-2 ms-3">
                @auth
                    <!-- Show logout button if logged in -->
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                @else
                    <!-- Show register and login buttons if not logged in -->
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Daftar</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                @endauth
            </div>
        </div>
    </nav>
    
    <section class="hero fade-in">
        <h1 class="display-4 fw-bold mb-3">Selamat Datang di Portal Fakultas Teknik</h1>
        <p class="lead mb-4">Akses informasi, agenda, dan layanan kampus dengan mudah dan cepat.</p>
        <a href="#informasi" class="btn btn-light btn-lg shadow">Informasi Terbaru <i class="bi bi-arrow-down"></i></a>
    </section>
    <!-- SLIDER INFORMASI -->
    <section class="container my-5 fade-in" id="informasi">
        <h2 class="mb-4 text-center fw-bold">Informasi Terbaru</h2>
        <div id="sliderInfo" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php $i = 0; @endphp
                @foreach($sliderInformasi as $info)
                <div class="carousel-item @if($i==0) active @endif">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            @if($info->gambar)
                                <img src="{{ asset($info->gambar) }}" class="d-block w-100 slider-img" alt="{{ $info->judul }}">
                            @else
                                <img src="{{ asset('sb-admin-2/img/slider'.(($i%3)+1).'.jpg') }}" class="d-block w-100 slider-img" alt="Slider Foto {{ $i+1 }}">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h4 class="fw-bold">{{ $info->judul }}</h4>
                            <p>{{ Str::limit($info->konten, 120) }}</p>
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                <span class="badge bg-primary">{{ $info->created_at->format('d M Y') }}</span>
                                @if($info->user && $info->user->role === 'admin')
                                    <span class="badge bg-danger">
                                        <i class="bi bi-broadcast me-1"></i> Update Admin
                                    </span>
                                @elseif($info->user && $info->user->role === 'dosen')
                                    <span class="badge bg-success">
                                        <i class="bi bi-person-badge me-1"></i> Info Dosen
                                    </span>
                                @endif
                                @if($info->agenda)
                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-calendar-event me-1"></i> {{ $info->agenda->judul }}
                                    </span>
                                @endif
                            </div>
                            <a href="{{ auth()->check() ? (auth()->user()->role === 'mahasiswa' ? route('mahasiswa.informasi.show', $info->id) : (auth()->user()->role === 'admin' ? route('admin.informasi.show', $info->id) : (auth()->user()->role === 'dosen' ? route('dosen.view.informasi', $info->id) : route('login')))) : route('login') }}" class="btn btn-sm btn-outline-primary">Baca selengkapnya 
                                @if($info->allComments && $info->allComments->count() > 0) 
                                    <span class="badge bg-secondary rounded-pill">{{ $info->allComments->count() }} komentar</span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                @php $i++; @endphp
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#sliderInfo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#sliderInfo" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="row g-4">
            @foreach($latestInformasi as $info)
            <div class="col-md-4">
                <div class="card info-card h-100 shadow-sm {{ $info->user && $info->user->role === 'admin' ? 'border-danger' : '' }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $info->judul }}</h5>
                        <p class="card-text">{{ Str::limit($info->konten, 100) }}</p>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            @if($info->user && $info->user->role === 'admin')
                                <span class="badge bg-danger">
                                    <i class="bi bi-broadcast me-1"></i> Update Admin
                                </span>
                            @elseif($info->user && $info->user->role === 'dosen')
                                <span class="badge bg-success">
                                    <i class="bi bi-person-badge me-1"></i> Info Dosen
                                </span>
                            @endif
                            @if($info->agenda)
                                <span class="badge bg-info text-dark">
                                    <i class="bi bi-calendar-event me-1"></i> {{ $info->agenda->judul }}
                                </span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-primary">{{ $info->created_at->format('d M Y') }}</span>
                            <span class="text-muted small">Oleh: {{ $info->user->name }}</span>
                        </div>
                        <div class="mt-3">
                            <a href="{{ auth()->check() ? (auth()->user()->role === 'mahasiswa' ? route('mahasiswa.informasi.show', $info->id) : (auth()->user()->role === 'admin' ? route('admin.informasi.show', $info->id) : (auth()->user()->role === 'dosen' ? route('dosen.view.informasi', $info->id) : route('login')))) : route('login') }}" class="btn btn-sm btn-outline-primary">Baca selengkapnya 
                                @if($info->allComments && $info->allComments->count() > 0) 
                                    <span class="badge bg-secondary rounded-pill">{{ $info->allComments->count() }} komentar</span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- AGENDA SECTION -->
    <section class="container my-5 fade-in" id="agenda">
        <h2 class="mb-4 text-center fw-bold">Agenda Fakultas</h2>
        <div class="row g-4">
            @foreach($latestAgendas as $agenda)
            <div class="col-md-4">
                <div class="card info-card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $agenda->judul }}</h5>
                        <p class="card-text">{{ Str::limit($agenda->deskripsi, 100) }}</p>
                        <div class="mb-2"><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y, H:i') }}</div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="badge bg-info">{{ $agenda->kategori->nama ?? 'Umum' }}</span>
                            <span class="text-muted small">Oleh: {{ $agenda->user->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- AGENDA BY CATEGORY SECTIONS -->
    @foreach($kategoriAgendas as $kategori)
    <section class="container my-5 fade-in" id="agenda-{{ $kategori->id }}">
        <h2 class="mb-4 text-center fw-bold">Agenda {{ $kategori->nama }}</h2>
        <div class="row g-4">
            @if($agendasByCategory[$kategori->id]->count() > 0)
                @foreach($agendasByCategory[$kategori->id] as $agenda)
                <div class="col-md-4">
                    <div class="card info-card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $agenda->judul }}</h5>
                            <p class="card-text">{{ Str::limit($agenda->deskripsi, 100) }}</p>
                            <div class="mb-2"><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y, H:i') }}</div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="badge bg-info">{{ $agenda->kategori->nama ?? 'Umum' }}</span>
                                <span class="text-muted small">Oleh: {{ $agenda->user->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i> Belum ada agenda untuk kategori ini
                    </div>
                </div>
            @endif
        </div>
    </section>
    @endforeach
    <!-- KOMENTAR SECTION -->
    <section class="container my-5 fade-in" id="komentar">
        <h2 class="mb-4 text-center fw-bold">Komentar Mahasiswa</h2>
        <div class="row g-4">
            @foreach(\App\Models\Komentar::with('user')->latest()->take(3)->get() as $komentar)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm bg-light">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-person-circle fs-2 text-primary me-2"></i>
                            <div>
                                <div class="fw-bold">{{ $komentar->user->name ?? 'Mahasiswa' }}</div>
                                <div class="text-muted small">{{ $komentar->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                        <blockquote class="blockquote mb-0">
                            <p class="fst-italic">"{{ $komentar->isi }}"</p>
                        </blockquote>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <footer class="bg-primary text-white text-center py-4 mt-5">
        <div class="container">
            <img src="{{ asset('sb-admin-2/img/logo.png') }}" alt="Logo" style="height:32px;"> <br>
            <span class="fw-bold">Portal Fakultas</span> &copy; {{ date('Y') }}
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
            
            // Get all nav links
            const navLinks = document.querySelectorAll('.nav-pills .nav-link');
            
            // Add smooth scrolling to all anchor links
            function addSmoothScroll(linkSelector) {
                const links = document.querySelectorAll(linkSelector);
                links.forEach(link => {
                    link.addEventListener('click', function(e) {
                        if (this.getAttribute('href').startsWith('#')) {
                            e.preventDefault();
                            const targetId = this.getAttribute('href');
                            const targetElement = document.querySelector(targetId);
                            
                            if (targetElement) {
                                window.scrollTo({
                                    top: targetElement.offsetTop - 80,
                                    behavior: 'smooth'
                                });
                            }
                        }
                    });
                });
            }
            
            // Apply smooth scrolling to nav links and dropdown items
            addSmoothScroll('.navbar-nav .nav-link[href^="#"]');
            addSmoothScroll('.dropdown-menu .dropdown-item[href^="#"]');
            
            // Update active state on scroll
            window.addEventListener('scroll', function() {
                let current = '';
                const sections = document.querySelectorAll('section[id]');
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (window.scrollY >= sectionTop - 100) {
                        current = '#' + section.getAttribute('id');
                    }
                });
                
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === current) {
                        link.classList.add('active');
                    }
                });
            });
            
            // Set first nav link as active by default
            if (navLinks.length > 0) {
                navLinks[0].classList.add('active');
            }
        });
    </script>
</body>
</html>
