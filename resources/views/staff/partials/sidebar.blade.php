<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('image/logounp.png') }}" alt="Logo" style="height:36px;">
        </div>
        <div class="sidebar-brand-text mx-3">Staff Fakultas</div>
    </a>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('staff.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('staff.agenda.index') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Agenda Internal</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('staff.informasi.create') }}">
            <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>
            Tambah Informasi Administratif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-globe fa-sm fa-fw mr-2 text-gray-400"></i>
            Dashboard Website
        </a>
    </li>
    <!-- Tambah menu lain di sini -->
</ul>
