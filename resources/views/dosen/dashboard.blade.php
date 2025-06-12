@extends('layouts.dosen')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Dosen</h1>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat datang, {{ Auth::user()->name }}!</h6>
            </div>
            <div class="card-body">
                <p>Sebagai dosen, Anda dapat mengelola informasi dan agenda Fakultas Teknik.</p>
                <p>Fitur utama: Membuat informasi akademik dan mengelola agenda kegiatan.</p>
                <div class="mt-3">
                    <a href="{{ route('dosen.informasi.index') }}" class="btn btn-primary me-2"><i class="fas fa-bullhorn me-1"></i> Kelola Informasi</a>
                    <a href="{{ route('dosen.agenda.index') }}" class="btn btn-success"><i class="fas fa-calendar-plus me-1"></i> Kelola Agenda</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Informasi Anda</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Informasi::where('user_id', Auth::id())->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Informasi Terbaru -->
    <div class="col-md-12 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Terbaru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Informasi::where('user_id', Auth::id())->latest()->take(5)->get() as $info)
                            <tr>
                                <td>{{ $info->judul }}</td>
                                <td>
                                    @if($info->is_published)
                                    <span class="badge badge-success">Dipublikasi</span>
                                    @else
                                    <span class="badge badge-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $info->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('dosen.informasi.edit', $info->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            
                            @if(App\Models\Informasi::where('user_id', Auth::id())->count() == 0)
                            <tr>
                                <td colspan="4" class="text-center">
                                    Belum ada informasi yang dibuat. 
                                    <a href="{{ route('dosen.informasi.create') }}">Buat informasi baru</a>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
