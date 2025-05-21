@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Kelola Komentar</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Komentar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pengguna</th>
                            <th>Komentar</th>
                            <th>Pada</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($komentars as $komentar)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle p-2 text-center me-2" style="width: 40px; height: 40px;">
                                            {{ substr($komentar->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $komentar->user->name }}</div>
                                            <span class="badge bg-secondary">{{ $komentar->user->role }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-2 {{ !$komentar->is_read ? 'fw-bold' : '' }}">{{ $komentar->isi }}</div>
                                    
                                    @if($komentar->replies->count() > 0)
                                        <div class="mt-2">
                                            <a class="btn btn-sm btn-outline-primary mb-2" data-bs-toggle="collapse" href="#replies-{{ $komentar->id }}" role="button" aria-expanded="false">
                                                <i class="bi bi-chat-dots"></i> Lihat {{ $komentar->replies->count() }} balasan
                                            </a>
                                            
                                            <div class="collapse" id="replies-{{ $komentar->id }}">
                                                @foreach($komentar->replies as $reply)
                                                    <div class="card card-body mb-2 bg-light comment-card">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex">
                                                                <div class="me-2">
                                                                    <div class="bg-primary text-white rounded-circle p-1 text-center" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                                        {{ substr($reply->user->name, 0, 1) }}
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-bold">{{ $reply->user->name }}</div>
                                                                    <div class="text-muted small">{{ $reply->created_at->format('d M Y, H:i') }}</div>
                                                                    <div>{{ $reply->isi }}</div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div>
                                                                <form action="{{ route('admin.komentar.destroy', $reply->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus balasan ini dari {{ $reply->user->name }}?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#reply-form-{{ $komentar->id }}" aria-expanded="false">
                                            <i class="bi bi-reply"></i> Balas
                                        </button>
                                        
                                        <div class="collapse mt-2" id="reply-form-{{ $komentar->id }}">
                                            <form action="{{ route('admin.komentar.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                                                <div class="mb-2">
                                                    <textarea class="form-control" name="isi" rows="2" placeholder="Tulis balasan Anda..." required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-success">Kirim Balasan</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($komentar->commentable_type == 'App\\Models\\Informasi')
                                        <a href="{{ route('admin.informasi.edit', $komentar->commentable_id) }}" class="text-decoration-none">
                                            Informasi: {{ $komentar->commentable->judul ?? 'Tidak ditemukan' }}
                                        </a>
                                    @else
                                        {{ class_basename($komentar->commentable_type) ?? 'Unknown' }}: {{ $komentar->commentable_id }}
                                    @endif
                                </td>
                                <td>{{ $komentar->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.komentar.destroy', $komentar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini dari {{ $komentar->user->name }}?\n\nJika komentar ini memiliki balasan, Anda perlu menghapus balasan terlebih dahulu.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="bi bi-chat-left-text display-4 text-muted"></i>
                                    <p class="mt-2">Belum ada komentar dari mahasiswa.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $komentars->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
