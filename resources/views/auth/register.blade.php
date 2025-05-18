<x-guest-layout>
    <div class="card auth-card">
        <div class="auth-header">
            <h4 class="m-0 fw-bold">Daftar Akun Mahasiswa</h4>
            <p class="mb-0 mt-2 small">Silakan isi form untuk membuat akun baru</p>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Hidden role input -->
                <input type="hidden" name="role" value="mahasiswa">

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap">
                    </div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan alamat email">
                    </div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukkan password min. 8 karakter">
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Masukkan ulang password">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('login') }}" class="text-decoration-none">Sudah punya akun? Login</a>
                    <button type="submit" class="btn btn-outline-primary px-4">
                        <i class="bi bi-person-plus me-2"></i> Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
