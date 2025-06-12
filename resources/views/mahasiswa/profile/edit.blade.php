@extends('layouts.mahasiswa')

@section('content')
<div class="neo-page-header position-relative" style="background-color: var(--secondary); padding: 3rem 0; overflow: hidden;">
    <!-- Neobrutalism geometric decorations -->
    <div class="position-absolute" style="width: 80px; height: 80px; background-color: var(--accent); border: 5px solid var(--dark); transform: rotate(15deg); top: 20px; left: 10%;"></div>
    <div class="position-absolute" style="width: 120px; height: 120px; background-color: var(--primary); border: 5px solid var(--dark); transform: rotate(30deg); top: -30px; right: 15%;"></div>
    <div class="position-absolute" style="width: 60px; height: 60px; background-color: white; border: 5px solid var(--dark); transform: rotate(-10deg); bottom: 20px; left: 20%;"></div>
    
    <div class="container position-relative">
        <h1 class="fw-black text-uppercase" style="font-size: 2.5rem; letter-spacing: 2px; text-shadow: 4px 4px 0 var(--dark);">Profil Saya</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Back button -->
            <a href="{{ route('mahasiswa.landing') }}" class="neo-btn mb-4" style="background-color: white; display: inline-flex; align-items: center;">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
            </a>

            <!-- Profile Information Card -->
            <div class="neo-card mb-5">
                <div class="neo-card-header py-3" style="background-color: var(--accent);">
                    <h5 class="m-0 fw-black" style="text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center;">
                        <i class="bi bi-person-circle me-2"></i> Informasi Profil
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="mb-4" style="font-size: 1.1rem;">
                        Perbarui informasi profil dan alamat email akun Anda.
                    </p>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
                        @csrf
                        @method('patch')

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold text-uppercase" style="letter-spacing: 0.5px;">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name', auth()->user()->name) }}" 
                                style="border: 4px solid var(--dark); border-radius: 0; padding: 12px 15px; font-size: 1.05rem; box-shadow: 4px 4px 0 rgba(0,0,0,0.1);">
                            @error('name')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-uppercase" style="letter-spacing: 0.5px;">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                style="border: 4px solid var(--dark); border-radius: 0; padding: 12px 15px; font-size: 1.05rem; box-shadow: 4px 4px 0 rgba(0,0,0,0.1);">
                            @error('email')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="neo-btn" style="background-color: var(--accent); color: var(--dark); border-width: 3px; box-shadow: 6px 6px 0 var(--dark); display: inline-flex; align-items: center; gap: 6px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                            <i class="bi bi-check2"></i> Simpan
                        </button>

                        @if (session('status') === 'profile-updated')
                            <div class="alert alert-success mt-3" role="alert" style="border: 3px solid var(--dark); border-radius: 0; box-shadow: 5px 5px 0 var(--dark);">
                                Profil berhasil diperbarui!
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="neo-card mb-5">
                <div class="neo-card-header py-3" style="background-color: var(--secondary);">
                    <h5 class="m-0 fw-black" style="text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center;">
                        <i class="bi bi-key me-2"></i> Perbarui Kata Sandi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="mb-4" style="font-size: 1.1rem;">
                        Pastikan akun Anda menggunakan kata sandi yang kuat untuk keamanan.
                    </p>

                    <form method="post" action="{{ route('password.update') }}" class="mt-4">
                        @csrf
                        @method('put')

                        <div class="mb-4">
                            <label for="current_password" class="form-label fw-bold text-uppercase" style="letter-spacing: 0.5px;">Kata Sandi Saat Ini</label>
                            <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                                id="current_password" name="current_password"
                                style="border: 4px solid var(--dark); border-radius: 0; padding: 12px 15px; font-size: 1.05rem; box-shadow: 4px 4px 0 rgba(0,0,0,0.1);">
                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold text-uppercase" style="letter-spacing: 0.5px;">Kata Sandi Baru</label>
                            <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                                id="password" name="password"
                                style="border: 4px solid var(--dark); border-radius: 0; padding: 12px 15px; font-size: 1.05rem; box-shadow: 4px 4px 0 rgba(0,0,0,0.1);">
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold text-uppercase" style="letter-spacing: 0.5px;">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control" 
                                id="password_confirmation" name="password_confirmation"
                                style="border: 4px solid var(--dark); border-radius: 0; padding: 12px 15px; font-size: 1.05rem; box-shadow: 4px 4px 0 rgba(0,0,0,0.1);">
                        </div>

                        <button type="submit" class="neo-btn" style="background-color: var(--secondary); color: var(--dark); border-width: 3px; box-shadow: 6px 6px 0 var(--dark); display: inline-flex; align-items: center; gap: 6px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                            <i class="bi bi-check2"></i> Simpan
                        </button>

                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success mt-3" role="alert" style="border: 3px solid var(--dark); border-radius: 0; box-shadow: 5px 5px 0 var(--dark);">
                                Kata sandi berhasil diperbarui!
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="neo-card mb-5">
                <div class="neo-card-header py-3" style="background-color: var(--primary);">
                    <h5 class="m-0 fw-black" style="text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; color: white;">
                        <i class="bi bi-exclamation-triangle me-2"></i> Hapus Akun
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="mb-4" style="font-size: 1.1rem;">
                        Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Silakan unduh data atau informasi yang ingin Anda simpan sebelum menghapus akun.
                    </p>

                    <button type="button" class="neo-btn" style="background-color: var(--primary); color: white; border-width: 3px; box-shadow: 6px 6px 0 var(--dark); display: inline-flex; align-items: center; gap: 6px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;"
                        data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        <i class="bi bi-trash"></i> Hapus Akun
                    </button>

                    <!-- Delete Account Modal -->
                    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="border: 6px solid var(--dark); border-radius: 0; box-shadow: 12px 12px 0 var(--dark);">
                                <div class="modal-header" style="border-bottom: 4px solid var(--dark); background-color: var(--primary); color: white;">
                                    <h5 class="modal-title fw-black text-uppercase" id="deleteAccountModalLabel">Konfirmasi Hapus Akun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="fw-bold">Apakah Anda yakin ingin menghapus akun Anda?</p>
                                    <p>Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengkonfirmasi.</p>
                                    
                                    <form method="post" action="{{ route('profile.destroy') }}" class="mt-4">
                                        @csrf
                                        @method('delete')

                                        <div class="mb-4">
                                            <label for="delete_password" class="form-label fw-bold text-uppercase" style="letter-spacing: 0.5px;">Kata Sandi</label>
                                            <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                                id="delete_password" name="password"
                                                style="border: 3px solid var(--dark); border-radius: 0; padding: 10px;">
                                            @error('password', 'userDeletion')
                                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="button" class="neo-btn" style="background-color: white; border-width: 3px; box-shadow: 4px 4px 0 var(--dark);" data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="neo-btn" style="background-color: var(--primary); color: white; border-width: 3px; box-shadow: 4px 4px 0 var(--dark);">
                                                Hapus Akun
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Profile Info Sidebar -->
            <div class="neo-card mb-4 position-relative" style="transform: rotate(1deg);">
                <!-- Decorative elements -->
                <div class="position-absolute" style="width: 30px; height: 30px; background-color: var(--primary); border: 3px solid var(--dark); top: -15px; right: 20px; transform: rotate(15deg);"></div>
                
                <div class="neo-card-header py-3" style="background-color: var(--accent);">
                    <h5 class="m-0 fw-black" style="text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center;">
                        <i class="bi bi-info-circle me-2"></i> Info Akun
                    </h5>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mb-4" style="width: 100px; height: 100px; border: 5px solid var(--dark); background-color: var(--primary); color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; transform: rotate(-3deg); box-shadow: 6px 6px 0 var(--dark);">
                        <span style="font-weight: 900; font-size: 3rem;">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    
                    <h4 class="fw-black mb-1">{{ auth()->user()->name }}</h4>
                    <p class="mb-3"><span class="neo-badge" style="background-color: var(--secondary);">{{ strtoupper(auth()->user()->role) }}</span></p>
                    <p class="mb-3"><i class="bi bi-envelope me-1"></i> {{ auth()->user()->email }}</p>
                    
                    <hr style="border-top: 3px solid var(--dark); opacity: 1; margin: 1.5rem 0;">
                    
                    <div class="mb-2">
                        <span class="fw-bold">Terakhir login:</span> {{ now()->format('d M Y, H:i') }}
                    </div>
                    
                    <div class="mb-3">
                        <span class="fw-bold">Bergabung sejak:</span> {{ auth()->user()->created_at->format('d M Y') }}
                    </div>
                </div>
            </div>

            <!-- Quick Links Neo Card -->
            <div class="neo-card" style="transform: rotate(-1deg); background-color: var(--secondary);">
                <div class="neo-card-header py-3" style="background-color: var(--dark); color: white;">
                    <h5 class="m-0 fw-black" style="text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center;">
                        <i class="bi bi-link-45deg me-2"></i> Tautan Cepat
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-2">
                        <a href="{{ route('mahasiswa.landing') }}" class="neo-btn" style="background-color: white; display: flex; align-items: center; gap: 8px; border-width: 3px; box-shadow: 4px 4px 0 var(--dark);">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                        <a href="{{ route('mahasiswa.informasi.index') }}" class="neo-btn" style="background-color: var(--light); display: flex; align-items: center; gap: 8px; border-width: 3px; box-shadow: 4px 4px 0 var(--dark);">
                            <i class="bi bi-info-circle"></i> Informasi
                        </a>
                        <a href="{{ route('mahasiswa.agenda') }}" class="neo-btn" style="background-color: var(--accent); display: flex; align-items: center; gap: 8px; border-width: 3px; box-shadow: 4px 4px 0 var(--dark);">
                            <i class="bi bi-calendar3"></i> Agenda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
