<!-- Neobrutalism-styled navigation for mahasiswa users -->
<nav class="navbar neo-navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('mahasiswa.landing') }}" style="display: flex; align-items: center; gap: 10px;">
            <div style="width: 40px; height: 40px; background-color: var(--accent); border: 3px solid white; transform: rotate(-5deg); display: flex; align-items: center; justify-content: center; box-shadow: 3px 3px 0 rgba(0,0,0,0.2);">
                <span style="font-weight: 900; color: var(--dark);">P</span>
            </div>
            <span style="font-weight: 900; text-transform: uppercase; letter-spacing: 1px; text-shadow: 1px 1px 0 rgba(0,0,0,0.3);">Portal Fakultas</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('mahasiswa.landing') ? 'active' : '' }}" href="{{ route('mahasiswa.landing') }}">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('mahasiswa.informasi*') ? 'active' : '' }}" href="{{ route('mahasiswa.informasi.index') }}">
                        <i class="bi bi-info-circle me-1"></i> Informasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('mahasiswa.agenda') ? 'active' : '' }}" href="{{ route('mahasiswa.agenda') }}">
                        <i class="bi bi-calendar3 me-1"></i> Agenda
                    </a>
                </li>
            </ul>
            
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="neo-btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                        style="background-color: var(--accent); color: var(--dark); border-width: 2px; box-shadow: 3px 3px 0 rgba(0,0,0,0.3); display: flex; align-items: center; gap: 8px; padding: 8px 16px;">
                        <div style="width: 30px; height: 30px; background-color: var(--primary); border: 2px solid var(--dark); border-radius: 0; display: flex; align-items: center; justify-content: center;">
                            <span style="font-weight: 900; font-size: 1rem; color: white;">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" 
                        style="border: 3px solid var(--dark); border-radius: 0; box-shadow: 6px 6px 0 var(--dark); padding: 0; overflow: hidden; min-width: 220px;">
                        <li style="border-bottom: 3px solid var(--dark);">
                            <div class="px-4 py-3">
                                <span class="d-block fw-bold">{{ Auth::user()->name }}</span>
                                <span class="d-block text-muted small">{{ Auth::user()->email }}</span>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item py-2 px-4" href="{{ route('profile.edit') }}" style="font-weight: 600;">
                                <i class="bi bi-person-circle me-2"></i> Profil Saya
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 px-4" style="font-weight: 600; color: var(--primary);">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Flash Message Alert -->
@if(session('success') || session('error') || session('warning') || session('info') || session('status'))
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="border: 3px solid var(--dark); border-radius: 0; box-shadow: 6px 6px 0 var(--dark);">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="border: 3px solid var(--dark); border-radius: 0; box-shadow: 6px 6px 0 var(--dark);">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert"
                style="border: 3px solid var(--dark); border-radius: 0; box-shadow: 6px 6px 0 var(--dark);">
                <i class="bi bi-exclamation-circle me-2"></i> {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert"
                style="border: 3px solid var(--dark); border-radius: 0; box-shadow: 6px 6px 0 var(--dark);">
                <i class="bi bi-info-circle me-2"></i> {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('status') && session('status') === 'profile-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="border: 3px solid var(--dark); border-radius: 0; box-shadow: 6px 6px 0 var(--dark);">
                <i class="bi bi-check-circle me-2"></i> Profil berhasil diperbarui!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
@endif
