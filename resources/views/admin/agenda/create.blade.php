@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Tambah Agenda</h3>
    <form action="{{ route('admin.agenda.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Agenda</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal dan Waktu</label>
            <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="kategori_agenda_id" class="form-label">Kategori</label>
            <select name="kategori_agenda_id" id="kategori_agenda_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoriAgendas as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
