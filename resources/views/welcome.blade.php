<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Fakultas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
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
        
        /* FullCalendar Neobrutalism Styling */
        .fc .fc-toolbar {
            margin-bottom: 1.5em;
        }
        
        .fc .fc-button {
            background-color: var(--primary);
            border: 2px solid var(--dark);
            box-shadow: 3px 3px 0 var(--dark);
            font-weight: bold;
            transition: transform 0.1s, box-shadow 0.1s;
        }
        
        .fc .fc-button:hover {
            background-color: var(--primary);
            transform: translate(1px, 1px);
            box-shadow: 2px 2px 0 var(--dark);
        }
        
        .fc .fc-button-primary:not(:disabled).fc-button-active, 
        .fc .fc-button-primary:not(:disabled):active {
            background-color: var(--secondary);
            color: var(--dark);
        }
        
        .fc-daygrid-day-frame {
            border: 1px solid #e0e0e0;
            transition: background-color 0.2s;
        }
        
        .fc-daygrid-day-frame:hover {
            background-color: #f8f8f8;
        }
        
        .fc-h-event {
            border-radius: 0;
            padding: 2px 5px;
            margin: 1px 0;
        }
        
        .fc-toolbar-title {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Outfit', sans-serif;
        }
        
        /* Mobile responsiveness for calendar */
        @media (max-width: 767px) {
            .fc .fc-toolbar {
                flex-direction: column;
                gap: 10px;
            }
            
            .fc .fc-toolbar-title {
                font-size: 1.2rem;
            }
            
            .fc-header-toolbar .fc-toolbar-chunk {
                display: flex;
                justify-content: center;
                margin-bottom: 10px;
            }
            
            .fc-view-harness {
                height: auto !important;
                min-height: 400px;
            }
            
            .neo-tooltip .tooltip-inner {
                max-width: 250px !important;
                padding: 8px !important;
            }
        }

        /* Neobrutalism Hero */
        .hero {
            background-color: var(--secondary);
            color: var(--dark);
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            position: relative;
            border: 6px solid var(--dark);
            box-shadow: 12px 12px 0 var(--dark);
            margin: 2rem;
            border-radius: 2px;
            overflow: hidden;
        }
        
        .hero h1 {
            font-weight: 900;
            font-size: 3.5rem;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 1.5rem;
        }
        
        .hero .lead {
            font-size: 1.3rem;
            max-width: 700px;
            margin: 0 auto 2rem;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -10%;
            width: 200px;
            height: 200px;
            background: var(--accent);
            transform: rotate(45deg);
            z-index: 0;
            border: 4px solid var(--dark);
        }
        
        /* Buttons */
        .neo-btn {
            background-color: var(--primary);
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            padding: 0.75rem 2rem;
            border: 4px solid var(--dark);
            box-shadow: 6px 6px 0 var(--dark);
            border-radius: 2px;
            transition: transform 0.1s, box-shadow 0.1s;
            position: relative;
            z-index: 5;
            text-decoration: none;
            display: inline-block;
        }
        
        .neo-btn:hover {
            transform: translate(2px, 2px);
            box-shadow: 4px 4px 0 var(--dark);
        }
        
        .neo-btn:active {
            transform: translate(6px, 6px);
            box-shadow: 0px 0px 0 var(--dark);
        }
        
        /* Cards */
        .neo-card {
            background-color: white;
            border: 4px solid var(--dark);
            box-shadow: 8px 8px 0 var(--dark);
            border-radius: 2px;
            padding: 1.5rem;
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
        }
        
        .neo-card:hover {
            transform: translate(4px, 4px);
            box-shadow: 4px 4px 0 var(--dark);
        }
        
        /* Section Headers */
        .neo-heading {
            position: relative;
            display: inline-block;
            background-color: var(--accent);
            padding: 0.5rem 2rem;
            margin-bottom: 3rem;
            border: 4px solid var(--dark);
            box-shadow: 6px 6px 0 var(--dark);
            transform: rotate(-2deg);
            font-weight: 900;
            text-transform: uppercase;
        }
        
        /* Images */
        .neo-img {
            border: 4px solid var(--dark);
            box-shadow: 6px 6px 0 var(--dark);
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        
        .slider-img {
            height: 350px;
            object-fit: cover;
        }
        
        /* Navigation */
        .neo-navbar {
            background-color: white;
            border-bottom: 4px solid var(--dark);
            padding: 1rem;
        }
        
        .neo-navbar .navbar-brand {
            font-weight: 900;
            color: var(--dark);
            display: flex;
            align-items: center;
        }
        
        .neo-navbar .nav-link {
            color: var(--dark) !important;
            font-weight: 700;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border: 2px solid transparent;
            transition: all 0.3s;
        }
        
        .neo-navbar .nav-link:hover,
        .neo-navbar .nav-link.active {
            background-color: var(--accent);
            border: 2px solid var(--dark);
            transform: translate(2px, 0);
        }
        
        /* Dropdown */
        .neo-dropdown-menu {
            border: 4px solid var(--dark);
            border-radius: 2px;
            box-shadow: 6px 6px 0 var(--dark);
            padding: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .neo-dropdown-item {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 0;
            border: 2px solid transparent;
        }
        
        .neo-dropdown-item:hover {
            background-color: var(--accent);
            border: 2px solid var(--dark);
            color: var(--dark);
        }
        
        /* Animation */
        .neo-fade-in {
            animation: neoFadeIn 1s ease-out;
        }
        
        @keyframes neoFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .neo-navbar .navbar-collapse {
                background-color: white;
                border: 4px solid var(--dark);
                box-shadow: 6px 6px 0 var(--dark);
                margin-top: 1rem;
                padding: 1rem;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero {
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg neo-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('image/logounp.png') }}" alt="Logo" style="height:48px; border: 3px solid var(--dark); margin-right:15px;"> 
                <span style="font-size:1.3rem; line-height:1.1;">PORTAL<br>FAKULTAS TEKNIK</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation" style="border:2px solid var(--dark);">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#informasi">INFORMASI</a></li>
                    <li class="nav-item"><a class="nav-link" href="#calendar">KALENDER</a></li>
                    
                    <!-- Dropdown Agenda -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarAgendaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            AGENDA
                        </a>
                        <ul class="dropdown-menu neo-dropdown-menu" aria-labelledby="navbarAgendaDropdown">
                            <li><a class="dropdown-item neo-dropdown-item" href="#agenda">Semua Agenda</a></li>
                            <li><hr class="dropdown-divider" style="border-top:2px solid var(--dark); opacity:0.3;"></li>
                            @foreach($kategoriAgendas as $kategori)
                            <li><a class="dropdown-item neo-dropdown-item" href="#agenda-{{ $kategori->id }}">{{ $kategori->nama }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    
                    <!-- Dropdown Informasi -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarInfoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            LAYANAN
                        </a>
                        <ul class="dropdown-menu neo-dropdown-menu" aria-labelledby="navbarInfoDropdown">
                            <li><a class="dropdown-item neo-dropdown-item" href="#berita">Berita</a></li>
                            <li><a class="dropdown-item neo-dropdown-item" href="#mingguan">Mingguan</a></li>
                            <li><a class="dropdown-item neo-dropdown-item" href="#kunjungan">Kunjungan Mahasiswa</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item"><a class="nav-link" href="#kemahasiswaan">KEMAHASISWAAN</a></li>
                    <li class="nav-item"><a class="nav-link" href="#komentar">KOMENTAR</a></li>
                </ul>
                <div class="d-flex gap-2 ms-3">
                @auth
                    <!-- Show logout button if logged in -->
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="neo-btn" style="background-color:var(--primary); font-size:0.9rem; padding:0.5rem 1.2rem;">LOGOUT</button>
                    </form>
                @else
                    <!-- Show register and login buttons if not logged in -->
                    <a href="{{ route('register') }}" class="neo-btn" style="background-color:var(--accent); color:var(--dark); font-size:0.9rem; padding:0.5rem 1.2rem;">DAFTAR</a>
                    <a href="{{ route('login') }}" class="neo-btn" style="background-color:var(--primary); font-size:0.9rem; padding:0.5rem 1.2rem;">LOGIN</a>
                @endauth
            </div>
        </div>
    </nav>
    
    <section class="hero neo-fade-in">
        <div class="position-absolute" style="top:-20px; right:80px; width:100px; height:100px; background:var(--primary); border:4px solid var(--dark); transform:rotate(15deg);"></div>
        <div class="position-absolute" style="bottom:40px; left:-30px; width:140px; height:140px; background:var(--accent); border:4px solid var(--dark); transform:rotate(35deg);"></div>
        
        <div class="position-relative">
            <h1>PORTAL FAKULTAS TEKNIK</h1>
            <p class="lead mb-4">Akses informasi, agenda, dan layanan kampus dengan mudah dan cepat.</p>
            <a href="#informasi" class="neo-btn">INFORMASI TERBARU <i class="bi bi-arrow-down ms-2"></i></a>
        </div>
    </section>
    <!-- SLIDER INFORMASI -->
    <section class="container my-5 neo-fade-in" id="informasi">
        <div class="text-center mb-5">
            <h2 class="neo-heading">Informasi Terbaru</h2>
        </div>
        
        <div id="sliderInfo" class="carousel slide mb-5" data-bs-ride="carousel" style="position:relative;">
            <div class="carousel-inner" style="border:5px solid var(--dark); box-shadow:12px 12px 0 var(--dark);">
                @php $i = 0; @endphp
                @foreach($sliderInformasi as $info)
                <div class="carousel-item @if($i==0) active @endif">
                    <div class="row align-items-center g-0">
                        <div class="col-md-6">
                            @if($info->gambar)
                                <img src="{{ asset($info->gambar) }}" class="d-block w-100 slider-img" alt="{{ $info->judul }}" style="border-right:5px solid var(--dark); border-radius:0;">
                            @else
                                <img src="{{ asset('sb-admin-2/img/slider'.(($i%3)+1).'.jpg') }}" class="d-block w-100 slider-img" alt="Slider Foto {{ $i+1 }}" style="border-right:5px solid var(--dark); border-radius:0;">
                            @endif
                        </div>
                        <div class="col-md-6 p-4" style="background-color:white;">
                            <h4 class="fw-bold" style="font-size:1.8rem; margin-bottom:1rem;">{{ $info->judul }}</h4>
                            <p style="font-size:1.1rem;">{{ Str::limit($info->konten, 120) }}</p>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span style="background-color:var(--secondary); font-weight:700; padding:0.25rem 0.75rem; border:2px solid var(--dark); box-shadow:3px 3px 0 var(--dark);">
                                    {{ $info->created_at->format('d M Y') }}
                                </span>
                                @if($info->user && $info->user->role === 'admin')
                                    <span style="background-color:var(--primary); color:white; font-weight:700; padding:0.25rem 0.75rem; border:2px solid var(--dark); box-shadow:3px 3px 0 var(--dark);">
                                        <i class="bi bi-broadcast me-1"></i> Update Admin
                                    </span>
                                @elseif($info->user && $info->user->role === 'dosen')
                                    <span style="background-color:var(--accent); color:var(--dark); font-weight:700; padding:0.25rem 0.75rem; border:2px solid var(--dark); box-shadow:3px 3px 0 var(--dark);">
                                        <i class="bi bi-person-badge me-1"></i> Info Dosen
                                    </span>
                                @endif
                                @if($info->agenda)
                                    <span style="background-color:#9aefff; color:var(--dark); font-weight:700; padding:0.25rem 0.75rem; border:2px solid var(--dark); box-shadow:3px 3px 0 var(--dark);">
                                        <i class="bi bi-calendar-event me-1"></i> {{ $info->agenda->judul }}
                                    </span>
                                @endif
                            </div>
                            <a href="{{ auth()->check() ? (auth()->user()->role === 'mahasiswa' ? route('mahasiswa.informasi.show', $info->id) : (auth()->user()->role === 'admin' ? route('admin.informasi.show', $info->id) : (auth()->user()->role === 'dosen' ? route('dosen.view.informasi', $info->id) : route('login')))) : route('login') }}" class="neo-btn" style="font-size:1rem; padding:0.5rem 1.5rem;">
                                BACA SELENGKAPNYA 
                                @if($info->allComments && $info->allComments->count() > 0) 
                                    <span style="background:white; color:var(--dark); padding:0.15rem 0.5rem; border-radius:10px; margin-left:0.5rem; font-size:0.8rem;">{{ $info->allComments->count() }} komentar</span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                @php $i++; @endphp
                @endforeach
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#sliderInfo" data-bs-slide="prev" style="width:60px; height:60px; background:white; top:50%; transform:translateY(-50%); left:-30px; border:4px solid var(--dark); opacity:1;">
                <i class="bi bi-chevron-left" style="color:var(--dark); font-size:1.5rem;"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#sliderInfo" data-bs-slide="next" style="width:60px; height:60px; background:white; top:50%; transform:translateY(-50%); right:-30px; border:4px solid var(--dark); opacity:1;">
                <i class="bi bi-chevron-right" style="color:var(--dark); font-size:1.5rem;"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="row g-4">
            @foreach($latestInformasi as $info)
            <div class="col-md-4 mb-4">
                <div class="neo-card h-100" style="{{ $info->user && $info->user->role === 'admin' ? 'border-color:var(--primary);' : '' }}">
                    <h5 class="fw-bold mb-3" style="font-size:1.4rem; line-height:1.3;">{{ $info->judul }}</h5>
                    <p style="font-size:1.05rem; margin-bottom:1.5rem;">{{ Str::limit($info->konten, 100) }}</p>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @if($info->user && $info->user->role === 'admin')
                            <span style="background-color:var(--primary); color:white; font-weight:700; padding:0.2rem 0.6rem; border:2px solid var(--dark); box-shadow:2px 2px 0 var(--dark);">
                                <i class="bi bi-broadcast me-1"></i> Admin
                            </span>
                        @elseif($info->user && $info->user->role === 'dosen')
                            <span style="background-color:var(--accent); color:var(--dark); font-weight:700; padding:0.2rem 0.6rem; border:2px solid var(--dark); box-shadow:2px 2px 0 var(--dark);">
                                <i class="bi bi-person-badge me-1"></i> Dosen
                            </span>
                        @endif
                        @if($info->agenda)
                            <span style="background-color:#9aefff; color:var(--dark); font-weight:700; padding:0.2rem 0.6rem; border:2px solid var(--dark); box-shadow:2px 2px 0 var(--dark);">
                                <i class="bi bi-calendar-event me-1"></i> {{ Str::limit($info->agenda->judul, 15) }}
                            </span>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-auto mb-3">
                        <span style="background-color:var(--secondary); font-weight:700; padding:0.2rem 0.6rem; border:2px solid var(--dark); font-size:0.85rem; box-shadow:2px 2px 0 var(--dark);">{{ $info->created_at->format('d M Y') }}</span>
                        <span style="font-weight:600; font-size:0.85rem;">{{ Str::limit($info->user->name, 15) }}</span>
                    </div>
                    <div class="mt-3">
                        <a href="{{ auth()->check() ? (auth()->user()->role === 'mahasiswa' ? route('mahasiswa.informasi.show', $info->id) : (auth()->user()->role === 'admin' ? route('admin.informasi.show', $info->id) : (auth()->user()->role === 'dosen' ? route('dosen.view.informasi', $info->id) : route('login')))) : route('login') }}" class="neo-btn w-100 text-center" style="font-size:0.9rem; padding:0.4rem 1rem; background-color:var(--primary);">
                            BACA SELENGKAPNYA 
                            @if($info->allComments && $info->allComments->count() > 0) 
                                <span style="background:white; color:var(--dark); padding:0.15rem 0.5rem; border-radius:10px; margin-left:0.5rem; font-size:0.8rem;">{{ $info->allComments->count() }}</span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- AGENDA SECTION -->
    <section class="container my-5 neo-fade-in" id="agenda" style="position:relative; z-index:1;">
        <div style="position:absolute; width:150px; height:150px; background:var(--secondary); border:5px solid var(--dark); transform:rotate(15deg); z-index:-1; top:-20px; right:30px;"></div>
        
        <div class="text-center mb-5">
            <h2 class="neo-heading" style="background-color:var(--primary); color:white;">Agenda Fakultas</h2>
        </div>
        
        <div class="row g-4">
            @foreach($latestAgendas as $agenda)
            <div class="col-md-4 mb-4">
                <div class="neo-card h-100" style="background-color:{{ ['#ffde59', '#4aff8b', '#ff9eb1', '#9aefff'][rand(0,3)] }};">
                    <h5 class="fw-bold mb-3" style="font-size:1.4rem; line-height:1.3;">{{ $agenda->judul }}</h5>
                    <p style="font-size:1.05rem; margin-bottom:1.5rem;">{{ Str::limit($agenda->deskripsi, 100) }}</p>
                    
                    <div class="mb-3 p-2" style="background:white; border:2px solid var(--dark); box-shadow:4px 4px 0 var(--dark); font-weight:600;">
                        <i class="bi bi-calendar-event me-2"></i> {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y, H:i') }}
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <span style="background-color:white; font-weight:700; padding:0.2rem 0.6rem; border:2px solid var(--dark); font-size:0.9rem; box-shadow:2px 2px 0 var(--dark);">
                            {{ $agenda->kategori->nama ?? 'Umum' }}
                        </span>
                        <span style="font-weight:600; font-size:0.85rem; background-color:white; padding:0.2rem 0.6rem; border:2px solid var(--dark); box-shadow:2px 2px 0 var(--dark);">
                            {{ Str::limit($agenda->user->name, 15) }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- CALENDAR SECTION -->
    <section class="container my-5 neo-fade-in" id="calendar" style="position:relative; z-index:1;">
        <div style="position:absolute; width:150px; height:150px; background:var(--accent); border:5px solid var(--dark); transform:rotate(-10deg); z-index:-1; top:-20px; left:30px;"></div>
        
        <div class="text-center mb-5">
            <h2 class="neo-heading" style="background-color:var(--secondary); color:var(--dark);">Kalender Kegiatan & Informasi</h2>
            <p class="lead mt-3">Temukan seluruh jadwal kegiatan dan informasi fakultas dalam satu tampilan</p>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="neo-card p-4" style="background-color:white;">
                    <div id="calendar"></div>
                    
                    <!-- Calendar Legend -->
                    <div class="calendar-legend mt-4 p-3 border rounded d-flex flex-wrap gap-3 justify-content-center">
                        <div class="d-flex align-items-center">
                            <span style="display:inline-block; width:20px; height:20px; background-color:#ff5252; border: 2px solid #121212; margin-right:5px;"></span>
                            <span>Agenda & Informasi</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span style="display:inline-block; width:20px; height:20px; background-color:#ffde59; border: 2px solid #121212; margin-right:5px;"></span>
                            <span>Agenda</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span style="display:inline-block; width:20px; height:20px; background-color:#4aff8b; border: 2px solid #121212; margin-right:5px;"></span>
                            <span>Informasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AGENDA BY CATEGORY SECTIONS -->
    @foreach($kategoriAgendas as $kategori)
    <section class="container my-5 neo-fade-in" id="agenda-{{ $kategori->id }}">
        <div class="text-center mb-5">
            <h2 class="neo-heading" style="background-color:#9aefff; transform:rotate({{ rand(-3, 3) }}deg);">Agenda {{ $kategori->nama }}</h2>
        </div>
        
        <div class="row g-4">
            @if($agendasByCategory[$kategori->id]->count() > 0)
                @foreach($agendasByCategory[$kategori->id] as $agenda)
                <div class="col-md-4 mb-4">
                    <div class="neo-card h-100" style="background-color:{{ ['#ffde59', '#4aff8b', '#ff9eb1', '#9aefff'][rand(0,3)] }};">
                        <h5 class="fw-bold mb-3" style="font-size:1.4rem; line-height:1.3;">{{ $agenda->judul }}</h5>
                        <p style="font-size:1.05rem; margin-bottom:1.5rem;">{{ Str::limit($agenda->deskripsi, 100) }}</p>
                        
                        <div class="mb-3 p-2" style="background:white; border:2px solid var(--dark); box-shadow:4px 4px 0 var(--dark); font-weight:600;">
                            <i class="bi bi-calendar-event me-2"></i> {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y, H:i') }}
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span style="background-color:white; font-weight:700; padding:0.2rem 0.6rem; border:2px solid var(--dark); font-size:0.9rem; box-shadow:2px 2px 0 var(--dark);">
                                {{ $agenda->kategori->nama ?? 'Umum' }}
                            </span>
                            <span style="font-weight:600; font-size:0.85rem; background-color:white; padding:0.2rem 0.6rem; border:2px solid var(--dark); box-shadow:2px 2px 0 var(--dark);">
                                {{ Str::limit($agenda->user->name, 15) }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <div style="background-color:white; border:4px solid var(--dark); box-shadow:8px 8px 0 var(--dark); padding:2rem;">
                        <i class="bi bi-info-circle me-2" style="font-size:2rem;"></i>
                        <p class="fs-5 fw-bold mb-0">Belum ada agenda untuk kategori ini</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @endforeach
    <!-- KOMENTAR SECTION -->
    <section class="container my-5 neo-fade-in" id="komentar">
        <div class="text-center mb-5">
            <h2 class="neo-heading" style="background-color:var(--accent); transform:rotate(-2deg);">Komentar Mahasiswa</h2>
        </div>
        
        <div class="row g-4">
            @foreach(\App\Models\Komentar::with('user')->latest()->take(3)->get() as $komentar)
            <div class="col-md-4 mb-4">
                <div style="position:relative; height:100%;">
                    <!-- Decorative elements -->
                    <div style="position:absolute; width:40px; height:40px; background:{{ ['var(--accent)', 'var(--primary)', 'var(--secondary)'][rand(0,2)] }}; border:3px solid var(--dark); top:-10px; right:-10px; z-index:1; transform:rotate({{ rand(10, 30) }}deg);"></div>
                    
                    <div class="neo-card h-100" style="background-color:white; z-index:2; position:relative;">
                        <div class="d-flex align-items-center mb-3" style="border-bottom:2px solid var(--dark); padding-bottom:1rem;">
                            <div style="width:50px; height:50px; border:3px solid var(--dark); border-radius:50%; display:flex; align-items:center; justify-content:center; background:var(--secondary); margin-right:1rem;">
                                <i class="bi bi-person-fill fs-3"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-5">{{ $komentar->user->name ?? 'Mahasiswa' }}</div>
                                <div style="font-weight:600; background:var(--accent); padding:0.1rem 0.5rem; display:inline-block; font-size:0.8rem; border:2px solid var(--dark);">
                                    {{ $komentar->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        <blockquote style="font-size:1.1rem; line-height:1.4;">
                            <p class="fst-italic">"{{ $komentar->isi }}"</p>
                        </blockquote>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize FullCalendar
            const calendarEl = document.getElementById('calendar');
            // Determine default view based on screen size
            const initialView = window.innerWidth < 768 ? 'listMonth' : 'dayGridMonth';
            
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: initialView,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },
                themeSystem: 'bootstrap5',
                // Responsive settings
                windowResize: function(view) {
                    if (window.innerWidth < 768) {
                        calendar.changeView('listMonth');
                    } else {
                        calendar.changeView('dayGridMonth');
                    }
                },
                events: function(info, successCallback, failureCallback) {
                    const month = info.start.getMonth() + 1; // FullCalendar months are 0-indexed
                    const year = info.start.getFullYear();
                    
                    // Use the optimized calendar endpoint that combines both data types
                    $.ajax({
                        url: '{{ url("api/v1/calendar") }}',
                        data: { month: month, year: year },
                        success: function(response) {
                            const informasiResponse = response.informasi;
                            const agendaResponse = response.agenda;
                            
                            // Process informasi events
                            const informasiEvents = informasiResponse.data.map(function(info) {
                                // Use agenda date if available, otherwise use created_at
                                let eventDate = null;
                                if (info.agenda && info.agenda.date) {
                                    eventDate = info.agenda.date;
                                } else {
                                    eventDate = info.created_at.split('T')[0]; // Extract YYYY-MM-DD
                                }
                                
                                return {
                                    id: 'informasi-' + info.id,
                                    title: info.title,
                                    start: eventDate,
                                    url: info.url || '{{ url("/informasi") }}' + '/' + info.id,
                                    backgroundColor: info.agenda ? '#ff5252' : '#4aff8b',
                                    borderColor: '#121212',
                                    textColor: info.agenda ? 'white' : '#121212',
                                    description: info.content ? (info.content.length > 100 ? info.content.substring(0, 100) + '...' : info.content) : '',
                                    extendedProps: {
                                        hasAgenda: !!info.agenda,
                                        type: info.agenda ? 'agenda-informasi' : 'informasi',
                                        image: info.image
                                    }
                                };
                            });
                            
                            // Process agenda events
                            const agendaEvents = agendaResponse.data.map(function(agenda) {
                                return {
                                    id: 'agenda-' + agenda.id,
                                    title: agenda.title,
                                    start: agenda.date,
                                    url: agenda.url || ('{{ url("/") }}' + '/agenda#' + agenda.id),
                                    backgroundColor: '#ffde59',
                                    borderColor: '#121212',
                                    textColor: '#121212',
                                    description: agenda.description || '',
                                    extendedProps: {
                                        hasAgenda: true,
                                        type: 'agenda',
                                        location: agenda.location
                                    }
                                };
                            });
                            
                            // Combine all events
                            const allEvents = [...informasiEvents, ...agendaEvents];
                            successCallback(allEvents);
                        },
                        error: function(error) {
                            console.error("Error fetching calendar data:", error);
                            failureCallback(error);
                        }
                    });
                },
                eventDidMount: function(info) {
                    // Add tooltips to calendar events
                    const eventType = info.event.extendedProps.type;
                    let badgeColor, icon, badgeText;
                    
                    // Determine badge color and icon based on event type
                    if (eventType === 'agenda') {
                        badgeColor = 'bg-warning text-dark';
                        icon = 'calendar-event';
                        badgeText = 'Agenda';
                    } else if (eventType === 'agenda-informasi') {
                        badgeColor = 'bg-danger';
                        icon = 'calendar-check';
                        badgeText = 'Agenda & Informasi';
                    } else {
                        badgeColor = 'bg-success';
                        icon = 'info-circle';
                        badgeText = 'Informasi';
                    }
                    
                    // Location information for agenda
                    let locationHtml = '';
                    if (info.event.extendedProps.location) {
                        locationHtml = `
                            <div class="mt-2">
                                <i class="bi bi-geo-alt"></i> ${info.event.extendedProps.location}
                            </div>
                        `;
                    }
                    
                    // Buat tooltip content dengan styling yang lebih menarik
                    const tooltipContent = `
                        <div style="max-width: 300px;">
                            <strong style="font-size: 1.1rem;">${info.event.title}</strong>
                            <div class="mt-2 mb-2">
                                ${info.event.extendedProps.description || ''}
                                ${locationHtml}
                            </div>
                            <div>
                                <span class="badge ${badgeColor}">
                                    <i class="bi bi-${icon}"></i> ${badgeText}
                                </span>
                                <span class="badge bg-secondary">
                                    <i class="bi bi-calendar"></i> ${info.event.start.toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'})}
                                </span>
                            </div>
                            <div class="mt-2 text-muted small">
                                Klik untuk melihat detail
                            </div>
                        </div>
                    `;
                    
                    $(info.el).tooltip({
                        title: tooltipContent,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body',
                        html: true,
                        template: '<div class="tooltip neo-tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner" style="background-color: white; color: black; border: 3px solid #121212; box-shadow: 3px 3px 0 #121212; max-width: 350px; text-align: left; padding: 10px;"></div></div>'
                    });
                },
                eventClick: function(info) {
                    if (info.event.url) {
                        window.location.href = info.event.url;
                        info.jsEvent.preventDefault(); // prevent browser from following link
                    }
                },
                // Custom styling
                eventContent: function(arg) {
                    const isAgenda = arg.event.extendedProps.hasAgenda;
                    const icon = isAgenda ? '<i class="bi bi-calendar-event"></i> ' : '<i class="bi bi-info-circle"></i> ';
                    
                    return {
                        html: '<div class="fc-event-main-frame" style="border: 3px solid #121212; box-shadow: 2px 2px 0 #121212;">' +
                              '<div class="fc-event-title-container">' +
                              '<div class="fc-event-title fc-sticky" style="font-weight: bold;">' + 
                              icon + arg.event.title + 
                              '</div>' +
                              '</div>' +
                              '</div>'
                    };
                }
            });
            calendar.render();
            
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
