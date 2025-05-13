@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Agenda Kegiatan Fakultas</h2>
    @foreach ($dataAgenda as $agenda)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $agenda->judul }}</h5>
                <p class="card-text">{{ $agenda->deskripsi }}</p>
                <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y, H:i') }}</p>
                <small class="text-muted">Disusun oleh: {{ $agenda->user->name }}</small>
            </div>
        </div>
    @endforeach
</div>
@endsection
