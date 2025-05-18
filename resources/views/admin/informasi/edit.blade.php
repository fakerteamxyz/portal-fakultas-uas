@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Edit Informasi</h3>
    <form action="{{ route('admin.informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ $informasi->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="konten" class="form-label">Konten</label>
            <textarea name="konten" id="konten" rows="5" class="form-control" required>{{ $informasi->konten }}</textarea>
        </div>
        <div class="mb-3">
            <label for="agenda_id" class="form-label">Agenda Terkait (opsional)</label>
            <select name="agenda_id" id="agenda_id" class="form-control">
                <option value="">-- Pilih Agenda (jika ada) --</option>
                @foreach($agendas as $agenda)
                    <option value="{{ $agenda->id }}" {{ $informasi->agenda_id == $agenda->id ? 'selected' : '' }}>
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
            
            @if($informasi->gambar)
                <div class="mt-2">
                    <p>Gambar saat ini:</p>
                    <img src="{{ asset($informasi->gambar) }}" alt="Gambar Informasi" style="max-width: 200px; max-height: 200px;" class="img-thumbnail">
                </div>
            @endif
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_published" id="is_published" {{ $informasi->is_published ? 'checked' : '' }}>
            <label class="form-check-label" for="is_published">
                Publikasikan
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
