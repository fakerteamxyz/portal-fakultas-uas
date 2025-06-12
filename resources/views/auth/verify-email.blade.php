<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="m-0 fw-black" style="font-size:2rem; text-transform:uppercase;">Verifikasi Email</h2>
            <p class="mb-0 mt-2" style="font-weight:600; font-size:1.1rem;">Lengkapi pendaftaran Anda</p>
        </div>
        <div class="p-4">
            <!-- Logo UNP -->
            <div class="text-center mb-4">
                <img src="{{ asset('image/logounp.png') }}" alt="Logo UNP" style="height:70px; border:4px solid var(--dark); padding:5px; transform:rotate(2deg);">
            </div>

            <div style="background-color:var(--light); border:4px solid var(--dark); box-shadow:8px 8px 0 var(--dark); padding:1.5rem; margin-bottom:1.5rem; font-weight:500; font-size:1.1rem;">
                Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan email baru.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div style="background-color:var(--accent); border:4px solid var(--dark); box-shadow:6px 6px 0 var(--dark); padding:1rem; margin-bottom:1.5rem;">
                    <p class="m-0 fw-bold">Link verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.</p>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
                <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                    @csrf
                    <button type="submit" class="neo-btn neo-btn-accent">
                        <i class="bi bi-envelope me-2"></i> KIRIM ULANG EMAIL VERIFIKASI
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mb-3">
                    @csrf
                    <button type="submit" class="neo-btn">
                        <i class="bi bi-box-arrow-right me-2"></i> LOGOUT
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
