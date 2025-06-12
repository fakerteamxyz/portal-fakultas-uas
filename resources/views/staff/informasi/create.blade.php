@extends('layouts.staff')

@section('c                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="neo-card" style="border-color: var(--accent);">
                <div class="neo-card-header py-3" style="background-color: var(--accent);">
                    <h6 class="m-0 font-weight-bold">Tips Pengisian</h6>
                </div>
                <div class="card-body">
                    <ul class="ps-3">
                        <li class="mb-2">Pastikan judul informatif dan mencerminkan isi.</li>
                        <li class="mb-2">Gunakan kalimat yang jelas dan mudah dipahami.</li>
                        <li class="mb-2">Berikan informasi lengkap terkait administrasi.</li>
                        <li class="mb-2">Sertakan deadline jika ada batas waktu tertentu.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<div class="container-fluid">
    <h1 class="h3 mb-4 text-dark fw-black" style="text-transform: uppercase; letter-spacing: 0.5px;">Tambah Informasi Administratif</h1>
    <div class="row">
        <div class="col-lg-8">
            <div class="neo-card mb-4">
                <div class="neo-card-header py-3">
                    <h6 class="m-0 font-weight-bold">Form Input Informasi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('staff.informasi.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="judul" class="form-label fw-bold mb-2" style="text-transform:uppercase; letter-spacing:0.5px;">Judul</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                                id="judul" value="{{ old('judul') }}" required 
                                style="border:3px solid var(--dark); border-radius:0; padding:12px 15px; font-size:1.1rem;">
                            @error('judul')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="isi" class="form-label fw-bold mb-2" style="text-transform:uppercase; letter-spacing:0.5px;">Isi Informasi</label>
                            <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" 
                                id="isi" rows="6" required 
                                style="border:3px solid var(--dark); border-radius:0; padding:12px 15px; font-size:1.1rem;">{{ old('isi') }}</textarea>
                            @error('isi')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="d-flex mt-4">
                            <button type="submit" class="neo-btn neo-btn-primary me-3">
                                <i class="fas fa-save me-2"></i> Simpan
                            </button>
                            <a href="{{ route('staff.informasi.index') }}" class="neo-btn">
                                <i class="fas fa-times me-2"></i> Batal
                            </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
