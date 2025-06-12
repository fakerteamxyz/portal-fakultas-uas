<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('image/logounp.png') }}" alt="Logo" style="height:36px;">
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
    <!-- Nav Item - Informasi Dropdown -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInformasi" aria-expanded="false" aria-controls="collapseInformasi">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Kelola Informasi</span>
            <i class="fas fa-angle-down ml-2"></i>
        </a>
        <div id="collapseInformasi" class="collapse" aria-labelledby="headingInformasi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Informasi:</h6>
                <a class="collapse-item" href="{{ route('dosen.informasi.index') }}">
                    <i class="fas fa-fw fa-list mr-1"></i> Daftar Informasi
                </a>
                <a class="collapse-item" href="{{ route('dosen.informasi.create') }}">
                    <i class="fas fa-fw fa-plus mr-1"></i> Tambah Informasi
                </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Agenda Dropdown -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAgenda" aria-expanded="false" aria-controls="collapseAgenda">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Kelola Agenda</span>
            <i class="fas fa-angle-down ml-2"></i>
        </a>
        <div id="collapseAgenda" class="collapse" aria-labelledby="headingAgenda" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Agenda:</h6>
                <a class="collapse-item" href="{{ route('dosen.agenda.index') }}">
                    <i class="fas fa-fw fa-calendar-alt mr-1"></i> Daftar Agenda
                </a>
                <a class="collapse-item" href="{{ route('dosen.agenda.create') }}">
                    <i class="fas fa-fw fa-plus mr-1"></i> Tambah Agenda
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}" target="_blank">
            <i class="fas fa-fw fa-globe"></i>
            <span>Dashboard Website</span>
        </a>
    </li>
    <!-- Tambah menu lain di sini -->
</ul>
