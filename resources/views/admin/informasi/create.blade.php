@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Tambah Informasi</h3>
    <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="konten" class="form-label">Konten</label>
            <textarea name="konten" id="konten" rows="5" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
            <small class="form-text text-muted">Upload gambar yang akan ditampilkan pada slider informasi. Format: JPG, PNG, GIF. Maksimal 2MB.</small>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_published" id="is_published">
            <label class="form-check-label" for="is_published">
                Publikasikan sekarang
            </label>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
