@extends('layouts.staff')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Staff</h1>
</div>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat datang, {{ Auth::user()->name }}!</h6>
            </div>
            <div class="card-body">
                <p>Sebagai staff, Anda membantu dalam administrasi dan koordinasi kegiatan fakultas.</p>
                <p>Fitur utama: Membuat dan menjadwalkan agenda kegiatan internal, serta mengelola informasi administrasi.</p>
                <div class="mt-3">
                    <a href="{{ route('staff.agenda.index') }}" class="btn btn-primary me-2"><i class="fas fa-calendar-plus me-1"></i> Kelola Agenda Internal</a>
                    <a href="{{ route('staff.informasi-admin.index') }}" class="btn btn-info"><i class="fas fa-clipboard-list me-1"></i> Kelola Informasi Admin</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
