@extends('layouts.staff')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detail Agenda</h1>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Judul</dt>
                        <dd class="col-sm-8">{{ $agenda->judul }}</dd>
                        <dt class="col-sm-4">Deskripsi</dt>
                        <dd class="col-sm-8">{{ $agenda->deskripsi }}</dd>
                        <dt class="col-sm-4">Tanggal</dt>
                        <dd class="col-sm-8">{{ $agenda->tanggal }}</dd>
                    </dl>
                    <a href="{{ route('staff.agenda.edit', $agenda->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('staff.agenda.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>

            @if(isset($agenda))
            <div class="card mt-4">
                <div class="card-header">Komentar</div>
                <div class="card-body">
                    <form action="{{ route('staff.komentar.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="agenda_id" value="{{ $agenda->id }}">
                        <div class="mb-3">
                            <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" rows="2" placeholder="Tulis komentar..." required></textarea>
                            @error('isi')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                    </form>
                    <hr>
                    @foreach($agenda->komentar as $komentar)
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
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
