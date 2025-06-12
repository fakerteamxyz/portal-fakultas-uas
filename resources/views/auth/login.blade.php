<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="m-0 fw-black" style="font-size:2.5rem; text-transform:uppercase;">LOGIN</h2>
            <p class="mb-0 mt-2" style="font-weight:600; font-size:1.1rem;">Silakan masuk ke akun Anda</p>
        </div>
        <div class="p-4">
            <!-- Logo UNP -->
            <div class="text-center mb-4">
                <img src="{{ asset('image/logounp.png') }}" alt="Logo UNP" style="height:80px; border:4px solid var(--dark); padding:5px; transform:rotate(-3deg);">
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div style="background-color:var(--accent); border:4px solid var(--dark); box-shadow:6px 6px 0 var(--dark); padding:1rem; margin-bottom:1.5rem;">
                    <p class="m-0 fw-bold">{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="neo-form-group">
                    <label for="email" class="neo-label">EMAIL</label>
                    <div class="neo-input-group">
                        <div class="neo-input-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <input id="email" type="email" class="neo-form-control neo-input-with-icon" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan alamat email">
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
                        <input id="password" type="password" class="neo-form-control neo-input-with-icon" name="password" required autocomplete="current-password" placeholder="Masukkan password">
                    </div>
                    @error('password')
                        <div class="errors-list">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="neo-check">
                    <input type="checkbox" id="remember_me" name="remember">
                    <label for="remember_me">Ingat saya</label>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
                    <div class="mb-3">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-weight:700; color:var(--primary); text-decoration:underline;">Lupa password?</a>
                        @endif
                    </div>
                    <div class="d-flex gap-2 flex-wrap mb-3">
                        <a href="{{ route('register') }}" class="neo-btn neo-btn-accent">
                            <i class="bi bi-person-plus me-1"></i> DAFTAR
                        </a>
                        <button type="submit" class="neo-btn">
                            <i class="bi bi-box-arrow-in-right me-1"></i> LOGIN
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
