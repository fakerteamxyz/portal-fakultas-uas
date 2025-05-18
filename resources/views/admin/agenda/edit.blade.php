@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Edit Agenda</h3>
    <form action="{{ route('admin.agenda.update', $agenda->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Agenda</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ $agenda->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" required>{{ $agenda->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal dan Waktu</label>
            <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($agenda->tanggal)) }}" required>
        </div>
        <div class="mb-3">
            <label for="kategori_agenda_id" class="form-label">Kategori</label>
            <select name="kategori_agenda_id" id="kategori_agenda_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoriAgendas as $kategori)
                    <option value="{{ $kategori->id }}" {{ $agenda->kategori_agenda_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
