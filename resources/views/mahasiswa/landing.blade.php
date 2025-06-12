<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Mahasiswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
        }
        
        .hero {
            background-color: var(--primary);
            color: var(--dark);
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            position: relative;
            border-bottom: 8px solid var(--dark);
            overflow: hidden;
        }
        
        .hero:before {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            background: var(--secondary);
            border: 6px solid var(--dark);
            top: 15%;
            left: 10%;
            transform: rotate(20deg);
            z-index: 1;
        }
        
        .hero:after {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            background: var(--accent);
            border: 6px solid var(--dark);
            bottom: 10%;
            right: 15%;
            transform: rotate(-15deg);
            z-index: 1;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero .btn {
            font-size: 1.2rem;
            padding: 0.75rem 2rem;
            font-weight: 800;
            border: 6px solid var(--dark);
            box-shadow: 10px 10px 0 var(--dark);
            border-radius: 0;
            transition: transform 0.2s, box-shadow 0.2s;
            background: white;
            color: var(--dark);
            text-transform: uppercase;
        }
        
        .hero .btn:hover {
            transform: translate(-5px, -5px);
            box-shadow: 15px 15px 0 var(--dark);
        }
        
        .feature-card {
            border: 6px solid var(--dark);
            box-shadow: 12px 12px 0 var(--dark);
            border-radius: 0;
            height: 100%;
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: white;
            overflow: hidden;
        }
        
        .feature-card:hover {
            transform: translate(-5px, -5px);
            box-shadow: 17px 17px 0 var(--dark);
        }
        
        .feature-card .icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            transform: rotate(-5deg);
        }
        
        .neo-navbar {
            background-color: var(--dark) !important;
            border-bottom: 5px solid var(--primary);
            padding: 1rem;
        }
        
        .neo-navbar .navbar-brand {
            font-weight: 900;
            color: white !important;
            letter-spacing: 1px;
        }
        
        .neo-navbar .nav-link {
            color: white !important;
            font-weight: 700;
            margin-right: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.3s;
        }
        
        .neo-navbar .nav-link:hover {
            color: var(--accent) !important;
        }
        
        .neo-btn-outline {
            background: white;
            border: 4px solid var(--dark);
            box-shadow: 6px 6px 0 var(--dark);
            border-radius: 0;
            font-weight: 700;
            text-transform: uppercase;
            padding: 8px 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .neo-btn-outline:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0 var(--dark);
        }
        
        .neo-btn-danger {
            background-color: var(--primary);
            color: white;
        }
        
        .section-title {
            position: relative;
            text-transform: uppercase;
            font-weight: 900;
            letter-spacing: 1px;
            padding-bottom: 1rem;
            margin-bottom: 3rem;
        }
        
        .section-title:after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 5px;
            background-color: var(--primary);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg neo-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('image/logounp.png') }}" alt="Logo" style="height:42px; border:3px solid white; padding:2px; transform: rotate(-3deg); margin-right:10px;"> Portal Mahasiswa
            </a>
            <div class="navbar-nav ms-auto">
                <a href="{{ url('/') }}" class="nav-link active"><i class="bi bi-house-fill me-1"></i> Kembali ke Home</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="neo-btn-outline neo-btn-danger ms-2"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                </form>
            </div>
        </div>
    </nav>
    
    <section class="hero">
        <div class="hero-content">
            <h1 class="display-4 fw-black mb-4" style="font-size:4rem; text-transform:uppercase; letter-spacing:2px;">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="lead mb-5" style="font-size:1.5rem; font-weight:600;">Akses informasi, agenda, dan layanan kampus dengan mudah dan cepat.</p>
            <a href="{{ url('/') }}" class="btn btn-lg">Lihat Portal Utama <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
    </section>
    
    <div class="container my-5 py-4">
        <h2 class="text-center section-title">Akses Cepat Layanan Mahasiswa</h2>
        <div class="row g-5">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-body text-center p-5">
                        <div class="icon" style="color: var(--primary);">
                            <i class="bi bi-megaphone-fill"></i>
                        </div>
                        <h3 class="mb-3 fw-bold text-uppercase" style="letter-spacing: 1px;">Informasi</h3>
                        <p class="mb-4" style="font-size: 1.1rem;">Akses pengumuman dan informasi penting dari kampus.</p>
                        <a href="{{ url('/') }}#informasi" class="neo-btn-outline" style="background: var(--primary); color: white;">Lihat Informasi <i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-body text-center p-5">
                        <div class="icon" style="color: var(--secondary);">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <h3 class="mb-3 fw-bold text-uppercase" style="letter-spacing: 1px;">Agenda</h3>
                        <p class="mb-4" style="font-size: 1.1rem;">Lihat jadwal kegiatan dan agenda penting fakultas.</p>
                        <a href="{{ url('/') }}#agenda" class="neo-btn-outline" style="background: var(--secondary); color: var(--dark);">Lihat Agenda <i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-body text-center p-5">
                        <div class="icon" style="color: var(--accent);">
                            <i class="bi bi-chat-quote-fill"></i>
                        </div>
                        <h3 class="mb-3 fw-bold text-uppercase" style="letter-spacing: 1px;">Testimoni</h3>
                        <p class="mb-4" style="font-size: 1.1rem;">Berikan komentar dan tanggapan Anda.</p>
                        <a href="{{ url('/') }}#komentar" class="neo-btn-outline" style="background: var(--accent); color: var(--dark);">Beri Tanggapan <i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer style="background-color: var(--dark); border-top: 6px solid var(--primary); padding: 2rem 0; margin-top: 4rem; color: white;" class="py-4">
        <div class="container text-center">
            <img src="{{ asset('image/logounp.png') }}" alt="Logo" style="height:60px; border:3px solid white; padding:2px; margin-bottom:20px;">
            <h3 class="fw-black text-uppercase" style="letter-spacing: 2px; color:var(--primary);">Portal Fakultas</h3>
            <p class="mb-2" style="font-weight: 600;">Universitas Negeri Padang</p>
            <p class="mb-3">© {{ date('Y') }} All Rights Reserved</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>