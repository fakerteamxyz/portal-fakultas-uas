<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="m-0 fw-black" style="font-size:2rem; text-transform:uppercase;">Konfirmasi Password</h2>
            <p class="mb-0 mt-2" style="font-weight:600; font-size:1.1rem;">Ini adalah area aman. Masukkan password Anda untuk melanjutkan.</p>
        </div>
        <div class="p-4">
            <!-- Logo UNP -->
            <div class="text-center mb-4">
                <img src="{{ asset('image/logounp.png') }}" alt="Logo UNP" style="height:70px; border:4px solid var(--dark); padding:5px; transform:rotate(-1deg);">
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="neo-form-group">
                    <label for="password" class="neo-label">PASSWORD</label>
                    <div class="neo-input-group">
                        <div class="neo-input-icon">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <input id="password" type="password" class="neo-form-control neo-input-with-icon" 
                                name="password" required autocomplete="current-password" 
                                placeholder="Masukkan password Anda">
                    </div>
                    @error('password')
                        <div class="errors-list">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="neo-btn">
                        <i class="bi bi-check-circle me-2"></i> KONFIRMASI
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
