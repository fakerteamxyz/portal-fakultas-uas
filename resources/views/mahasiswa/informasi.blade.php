@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Informasi</h2>
    @foreach ($dataInformasi as $info)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $info->judul }}</h5>
                <p class="card-text">{{ $info->isi }}</p>
                <small class="text-muted">Dibuat oleh: {{ $info->user->name }} | {{ $info->created_at->format('d M Y') }}</small>
            </div>
        </div>
    @endforeach
</div>
@endsection
