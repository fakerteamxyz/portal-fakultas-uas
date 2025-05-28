@extends('layouts.staff')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detail Informasi Administratif</h1>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Judul</dt>
                        <dd class="col-sm-8">{{ $informasi->judul }}</dd>
                        <dt class="col-sm-4">Isi Informasi</dt>
                        <dd class="col-sm-8">{!! nl2br(e($informasi->konten)) !!}</dd>
                        <dt class="col-sm-4">Tanggal Dibuat</dt>
                        <dd class="col-sm-8">{{ $informasi->created_at->format('d-m-Y H:i') }}</dd>
                    </dl>
                    <a href="{{ route('staff.informasi.edit', $informasi->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('staff.informasi.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>

            @if(isset($informasi))
            <div class="card mt-4">
                <div class="card-header">Komentar</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('staff.komentar.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="commentable_id" value="{{ $informasi->id }}">
                        <input type="hidden" name="commentable_type" value="App\\Models\\Informasi">
                        <div class="mb-3">
                            <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" rows="2" placeholder="Tulis komentar..." required></textarea>
                            @error('isi')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                    </form>
                    <hr>
                    @foreach($informasi->comments as $komentar)
                        <div class="mb-2">
                            <strong>{{ $komentar->user->name ?? 'User' }}</strong> <small class="text-muted">{{ $komentar->created_at->diffForHumans() }}</small>
                            <div>{{ $komentar->isi }}</div>
                            @if($komentar->user_id == auth()->id())
                            <form action="{{ route('staff.komentar.destroy', $komentar->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm btn-link p-0">Hapus</button>
                            </form>
                            @endif
                            @foreach($komentar->replies as $reply)
                                <div class="ml-4 border-left pl-2 mt-1">
                                    <strong>{{ $reply->user->name ?? 'User' }}</strong> <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                    <div>{{ $reply->isi }}</div>
                                </div>
                            @endforeach
                            <form action="{{ route('staff.komentar.store') }}" method="POST" class="mt-2 ml-4">
                                @csrf
                                <input type="hidden" name="commentable_id" value="{{ $informasi->id }}">
                                <input type="hidden" name="commentable_type" value="App\\Models\\Informasi">
                                <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="isi" class="form-control" placeholder="Balas komentar..." required>
                                    <button class="btn btn-secondary" type="submit">Balas</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
