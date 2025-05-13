<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">Admin Fakultas</div>
    </a>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelola User</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.informasi.index') }}">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Kelola Informasi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.kategori-agenda.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Kategori Agenda</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.komentar.index') }}">
            <i class="fas fa-fw fa-comments"></i>
            <span>Komentar Mahasiswa</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}" target="_blank">
            <i class="fas fa-fw fa-globe"></i>
            <span>Lihat Website</span>
        </a>
    </li>
    <!-- Tambah menu lain di sini -->
</ul>
