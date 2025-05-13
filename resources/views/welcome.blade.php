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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <img src="{{ asset('sb-admin-2/img/logo.png') }}" alt="Logo" style="height:40px;"> Portal Fakultas
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('register') }}" class="btn btn-success">Daftar Mahasiswa</a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
            </div>
        </div>
    </nav>
    <section class="hero fade-in">
        <h1 class="display-4 fw-bold mb-3">Selamat Datang di Portal Fakultas</h1>
        <p class="lead mb-4">Akses informasi, agenda, dan layanan kampus dengan mudah dan cepat.</p>
        <a href="#informasi" class="btn btn-light btn-lg shadow">Jelajahi Informasi <i class="bi bi-arrow-down"></i></a>
    </section>
    <!-- SLIDER INFORMASI -->
    <section class="container my-5 fade-in" id="informasi">
        <h2 class="mb-4 text-center fw-bold">Informasi Terbaru</h2>
        <div id="sliderInfo" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php $i = 0; @endphp
                @foreach(\App\Models\Informasi::where('is_published',1)->latest()->take(3)->get() as $info)
                <div class="carousel-item @if($i==0) active @endif">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <img src="{{ asset('sb-admin-2/img/slider'.(($i%3)+1).'.jpg') }}" class="d-block w-100 slider-img" alt="Slider Foto {{ $i+1 }}">
                        </div>
                        <div class="col-md-6">
                            <h4 class="fw-bold">{{ $info->judul }}</h4>
                            <p>{{ Str::limit($info->konten, 120) }}</p>
                            <span class="badge bg-primary">{{ $info->created_at->format('d M Y') }}</span>
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
            @foreach(\App\Models\Informasi::where('is_published',1)->latest()->take(3)->get() as $info)
            <div class="col-md-4">
                <div class="card info-card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $info->judul }}</h5>
                        <p class="card-text">{{ Str::limit($info->konten, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-primary">{{ $info->created_at->format('d M Y') }}</span>
                            <span class="text-muted small">Oleh: {{ $info->user->name }}</span>
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
            @foreach(\App\Models\Agenda::latest()->take(3)->get() as $agenda)
            <div class="col-md-4">
                <div class="card info-card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $agenda->judul }}</h5>
                        <p class="card-text">{{ Str::limit($agenda->deskripsi, 100) }}</p>
                        <div class="mb-2"><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y, H:i') }}</div>
                        <span class="text-muted small">Oleh: {{ $agenda->user->name }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- KOMENTAR SECTION -->
    <section class="container my-5 fade-in" id="komentar">
        <h2 class="mb-4 text-center fw-bold">Testimoni Mahasiswa</h2>
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
</body>
</html>
