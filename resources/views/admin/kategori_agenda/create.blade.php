@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Tambah Kategori Agenda</h3>
    <form action="{{ route('admin.kategori-agenda.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.kategori-agenda.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
