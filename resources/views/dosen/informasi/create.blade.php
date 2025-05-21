@extends('layouts.dosen')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Informasi Baru</h1>
    <a href="{{ route('dosen.informasi.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Informasi</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('dosen.informasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="judul">Judul Informasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
                @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="konten">Konten Informasi <span class="text-danger">*</span></label>
                <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="5" required>{{ old('konten') }}</textarea>
                @error('konten')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="gambar">Gambar (Opsional)</label>
                <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
                <small class="form-text text-muted">Format yang diizinkan: JPEG, PNG, JPG, GIF. Maksimal ukuran: 2MB.</small>
                @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="agenda_id">Terkait Agenda (Opsional)</label>
                <select class="form-control @error('agenda_id') is-invalid @enderror" id="agenda_id" name="agenda_id">
                    <option value="">-- Pilih Agenda --</option>
                    @foreach($agendas as $agenda)
                    <option value="{{ $agenda->id }}" {{ old('agenda_id') == $agenda->id ? 'selected' : '' }}>{{ $agenda->judul }}</option>
                    @endforeach
                </select>
                @error('agenda_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="is_published" name="is_published" {{ old('is_published') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_published">Publikasikan Informasi</label>
                    <small class="form-text text-muted">Jika tidak dicentang, informasi akan disimpan sebagai draft.</small>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Informasi
            </button>
        </form>
    </div>
</div>
@endsection
