<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="m-0 fw-black" style="font-size:2rem; text-transform:uppercase;">Buat Password Baru</h2>
            <p class="mb-0 mt-2" style="font-weight:600; font-size:1.1rem;">Masukkan password baru untuk akun Anda</p>
        </div>
        <div class="p-4">
            <!-- Logo UNP -->
            <div class="text-center mb-4">
                <img src="{{ asset('image/logounp.png') }}" alt="Logo UNP" style="height:70px; border:4px solid var(--dark); padding:5px; transform:rotate(2deg);">
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="neo-form-group">
                    <label for="email" class="neo-label">EMAIL</label>
                    <div class="neo-input-group">
                        <div class="neo-input-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <input id="email" type="email" class="neo-form-control neo-input-with-icon" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                    </div>
                    @error('email')
                        <div class="errors-list">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="neo-form-group">
                    <label for="password" class="neo-label">PASSWORD BARU</label>
                    <div class="neo-input-group">
                        <div class="neo-input-icon">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <input id="password" type="password" class="neo-form-control neo-input-with-icon" name="password" required autocomplete="new-password" placeholder="Masukkan password baru">
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
                        <input id="password_confirmation" type="password" class="neo-form-control neo-input-with-icon" 
                               name="password_confirmation" required autocomplete="new-password" 
                               placeholder="Masukkan ulang password baru">
                    </div>
                    @error('password_confirmation')
                        <div class="errors-list">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('login') }}" style="font-weight:700; color:var(--primary); text-decoration:underline;">
                        <i class="bi bi-arrow-left"></i> Kembali ke login
                    </a>
                    <button type="submit" class="neo-btn">
                        <i class="bi bi-check-circle me-2"></i> RESET PASSWORD
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
