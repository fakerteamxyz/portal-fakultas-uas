<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Mahasiswa</title>
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
        .feature-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(78,115,223,0.2);
        }
        .feature-card .icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <img src="{{ asset('sb-admin-2/img/logo.png') }}" alt="Logo" style="height:40px;"> Portal Mahasiswa
            </a>
            <div class="navbar-nav ms-auto">
                <a href="{{ url('/') }}" class="nav-link active"><i class="bi bi-house-fill me-1"></i> Kembali ke Home</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger ms-2"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                </form>
            </div>
        </div>
    </nav>
    
    <section class="hero fade-in">
        <h1 class="display-4 fw-bold mb-3">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="lead mb-4">Akses informasi, agenda, dan layanan kampus dengan mudah dan cepat.</p>
        <a href="{{ url('/') }}" class="btn btn-light btn-lg shadow">Lihat Portal Utama <i class="bi bi-arrow-right"></i></a>
    </section>
    
    <div class="container my-5">
        <h2 class="text-center mb-5">Akses Cepat Layanan Mahasiswa</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon text-primary">
                            <i class="bi bi-megaphone-fill"></i>
                        </div>
                        <h4>Informasi Kampus</h4>
                        <p>Akses pengumuman dan informasi penting dari kampus.</p>
                        <a href="{{ url('/') }}#informasi" class="btn btn-primary mt-3">Lihat Informasi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon text-warning">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <h4>Agenda Kegiatan</h4>
                        <p>Lihat jadwal kegiatan dan agenda penting fakultas.</p>
                        <a href="{{ url('/') }}#agenda" class="btn btn-warning mt-3">Lihat Agenda</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon text-success">
                            <i class="bi bi-chat-quote-fill"></i>
                        </div>
                        <h4>Testimoni</h4>
                        <p>Berikan komentar dan tanggapan Anda.</p>
                        <a href="{{ url('/') }}#komentar" class="btn btn-success mt-3">Beri Tanggapan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">Portal Fakultas © {{ date('Y') }} All Rights Reserved</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>