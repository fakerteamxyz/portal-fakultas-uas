<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Landing Page Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="text-center mb-4">
            <h1>Selamat Datang di Portal Fakultas</h1>
            <p class="lead">Anda login sebagai <strong>Mahasiswa</strong></p>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Fakultas</h5>
                        <p class="card-text">Lihat berita, pengumuman, atau informasi dari dosen dan staff fakultas.</p>
                        <a href="#" class="btn btn-primary">Lihat Informasi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Agenda Kegiatan</h5>
                        <p class="card-text">Jadwal seminar, workshop, kuliah umum, dan kegiatan lainnya.</p>
                        <a href="#" class="btn btn-success">Lihat Agenda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
