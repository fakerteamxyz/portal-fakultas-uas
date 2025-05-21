<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dosen Fakultas</div>
    </a>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.informasi.index') }}">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Kelola Informasi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.agenda.index') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Kelola Agenda</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}" target="_blank">
            <i class="fas fa-fw fa-globe"></i>
            <span>Dashboard Website</span>
        </a>
    </li>
    <!-- Tambah menu lain di sini -->
</ul>
