<x-guest-layout>
    <div class="card auth-card">
        <div class="auth-header">
            <h4 class="m-0 fw-bold">Login</h4>
            <p class="mb-0 mt-2 small">Silakan masuk ke akun Anda</p>
        </div>
        <div class="card-body p-4">
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success mb-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan alamat email">
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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan password">
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">Ingat saya</label>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa password?</a>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary me-2">
                            <i class="bi bi-person-plus me-1"></i> Daftar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
