<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header text-center">
            <img src="{{ asset('image/logounp.png') }}" alt="Logo UNP" style="height:80px; border:4px solid var(--dark); padding:5px; transform:rotate(3deg);">
            <h2 class="m-0 fw-black mt-3" style="font-size:2rem; text-transform:uppercase;">Daftar Akun Mahasiswa</h2>
            <p class="mb-0 mt-2" style="font-weight:600; font-size:1.1rem;">Silakan isi form untuk membuat akun baru</p>
        </div>
        <div class="p-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Hidden role input -->
                <input type="hidden" name="role" value="mahasiswa">

                <!-- Name -->
                <div class="neo-form-group">
                    <label for="name" class="neo-label">NAMA LENGKAP</label>
                    <div class="neo-input-group">
                        <div class="neo-input-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <input id="name" type="text" class="neo-form-control neo-input-with-icon" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap">
                    </div>
                    @error('name')
                        <div class="errors-list">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="neo-form-group">
                    <label for="email" class="neo-label">EMAIL</label>
                    <div class="neo-input-group">
                        <div class="neo-input-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <input id="email" type="email" class="neo-form-control neo-input-with-icon" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan alamat email">
                    </div>
                    @error('email')
                        <div class="errors-list">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="neo-form-group">
                    <label for="password" class="neo-label">PASSWORD</label>
                    <div class="neo-input-group">
                        <div class="neo-input-icon">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <input id="password" type="password" class="neo-form-control neo-input-with-icon" name="password" required autocomplete="new-password" placeholder="Masukkan password min. 8 karakter">
                    </div>
                    @error('password')
                        <div class="errors-list">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="neo-form-group">
                    <label for="password_confirmation" class="neo-label">KONFIRMASI PASSWORD</label>
                    <div class="neo-input-group">
                        <div class="neo-input-icon">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <input id="password_confirmation" type="password" class="neo-form-control neo-input-with-icon" name="password_confirmation" required autocomplete="new-password" placeholder="Masukkan ulang password">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
                    <div class="mb-3">
                        <a href="{{ route('login') }}" style="font-weight:700; color:var(--primary); text-decoration:underline;">Sudah punya akun? Login</a>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="neo-btn neo-btn-accent px-4">
                            <i class="bi bi-person-plus me-2"></i> DAFTAR
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
