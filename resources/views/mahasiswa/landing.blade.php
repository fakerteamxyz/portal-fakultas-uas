<x-app-layout>
    <x-slot name="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-primary shadow mb-4">
            <div class="container">
                <a class="navbar-brand text-white fw-bold" href="#">Portal Fakultas</a>
                <div class="ml-auto">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-light">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </x-slot>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-primary">Selamat Datang di Portal Fakultas</h1>
            <p class="lead">Anda login sebagai <span class="badge bg-success">Mahasiswa</span></p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5 mb-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-info-circle display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Informasi Fakultas</h5>
                        <p class="card-text">Lihat berita, pengumuman, atau informasi dari dosen dan staff fakultas.</p>
                        <a href="{{ route('mahasiswa.informasi') }}" class="btn btn-primary w-100">Lihat Informasi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mb-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-calendar-event display-4 text-success"></i>
                        </div>
                        <h5 class="card-title">Agenda Kegiatan</h5>
                        <p class="card-text">Jadwal seminar, workshop, kuliah umum, dan kegiatan lainnya.</p>
                        <a href="{{ route('mahasiswa.agenda') }}" class="btn btn-success w-100">Lihat Agenda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</x-app-layout>
