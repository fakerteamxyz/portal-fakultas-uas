<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="m-0 fw-black" style="font-size:2rem; text-transform:uppercase;">Reset Password</h2>
            <p class="mb-0 mt-2" style="font-weight:600; font-size:1.1rem;">Masukkan email Anda untuk mendapatkan link reset password</p>
        </div>
        <div class="p-4">
            <!-- Logo UNP -->
            <div class="text-center mb-4">
                <img src="{{ asset('image/logounp.png') }}" alt="Logo UNP" style="height:70px; border:4px solid var(--dark); padding:5px; transform:rotate(-2deg);">
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div style="background-color:var(--accent); border:4px solid var(--dark); box-shadow:6px 6px 0 var(--dark); padding:1rem; margin-bottom:1.5rem;">
                    <p class="m-0 fw-bold">{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="neo-form-group">
                    <label for="email" class="neo-label">EMAIL</label>
                    <div class="neo-input-group">
                        <div class="neo-input-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <input id="email" type="email" class="neo-form-control neo-input-with-icon" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan alamat email">
                    </div>
                    @error('email')
                        <div class="errors-list">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
                    <div class="mb-3">
                        <a href="{{ route('login') }}" style="font-weight:700; color:var(--primary); text-decoration:underline;">
                            <i class="bi bi-arrow-left"></i> Kembali ke login
                        </a>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="neo-btn neo-btn-primary px-4">
                            <i class="bi bi-envelope me-2"></i> KIRIM LINK RESET PASSWORD
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
