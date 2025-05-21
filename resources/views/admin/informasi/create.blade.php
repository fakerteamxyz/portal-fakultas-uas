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
            <label for="agenda_id" class="form-label">Agenda Terkait (opsional)</label>
            <select name="agenda_id" id="agenda_id" class="form-control">
                <option value="">-- Pilih Agenda (jika ada) --</option>
                @foreach($agendas as $agenda)
                    <option value="{{ $agenda->id }}">
                        {{ $agenda->judul }} - {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}
                        @if($agenda->kategori)
                            [{{ $agenda->kategori->nama }}]
                        @endif
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Pilih agenda yang terkait dengan informasi ini (jika ada).</small>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
            <small class="form-text text-muted">Upload gambar yang akan ditampilkan pada slider informasi. Format: JPG, PNG, GIF. Maksimal 2MB.</small>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_published" id="is_published" checked>
            <label class="form-check-label" for="is_published">
                Publikasikan sekarang
            </label>
            <small class="form-text d-block text-muted">Jika dicentang, informasi akan langsung terlihat oleh mahasiswa.</small>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save mr-1"></i> Simpan Informasi
            </button>
            <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary">
                <i class="fas fa-times mr-1"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection
