@extends('layouts.staff')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 fw-black" style="text-transform: uppercase; letter-spacing: 0.5px;">Dashboard Staff</h1>
</div>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="neo-card">
            <div class="neo-card-header py-3">
                <h6 class="m-0 font-weight-bold">Selamat datang, {{ Auth::user()->name }}!</h6>
            </div>
            <div class="card-body">
                <p style="font-size: 1.1rem;">Sebagai staff, Anda membantu dalam administrasi dan koordinasi kegiatan fakultas.</p>
                <p style="font-size: 1.1rem;">Fitur utama: Membuat dan menjadwalkan agenda kegiatan internal, serta mengelola informasi administrasi.</p>
                <div class="mt-4">
                    <a href="{{ route('staff.agenda.index') }}" class="neo-btn neo-btn-secondary me-3"><i class="fas fa-calendar-plus me-1"></i> Kelola Agenda Internal</a>
                    <a href="{{ route('staff.informasi.index') }}" class="neo-btn neo-btn-accent"><i class="fas fa-clipboard-list me-1"></i> Kelola Informasi Admin</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="neo-card text-center py-3" style="border-color: var(--primary);">
            <div class="card-body">
                <i class="fas fa-calendar-check fa-3x mb-3" style="color: var(--primary);"></i>
                <h2 class="fw-bold">Agenda</h2>
                <p class="fs-4 fw-bold">{{ \App\Models\Agenda::count() }}</p>
                <p>Total agenda yang dikelola</p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="neo-card text-center py-3" style="border-color: var(--secondary);">
            <div class="card-body">
                <i class="fas fa-info-circle fa-3x mb-3" style="color: var(--secondary);"></i>
                <h2 class="fw-bold">Informasi</h2>
                <p class="fs-4 fw-bold">{{ \App\Models\Informasi::count() }}</p>
                <p>Total informasi administrasi</p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="neo-card text-center py-3" style="border-color: var(--accent);">
            <div class="card-body">
                <i class="fas fa-users fa-3x mb-3" style="color: var(--accent);"></i>
                <h2 class="fw-bold">Pengguna</h2>
                <p class="fs-4 fw-bold">{{ \App\Models\User::count() }}</p>
                <p>Total pengguna portal</p>
            </div>
        </div>
    </div>
</div>
@endsection
