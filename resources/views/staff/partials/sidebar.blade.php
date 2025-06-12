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
    <!-- Nav Item - Agenda Dropdown -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAgenda" aria-expanded="false" aria-controls="collapseAgenda">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Agenda Internal</span>
            <i class="fas fa-angle-down ml-2"></i>
        </a>
        <div id="collapseAgenda" class="collapse" aria-labelledby="headingAgenda" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Agenda:</h6>
                <a class="collapse-item" href="{{ route('staff.agenda.index') }}">
                    <i class="fas fa-fw fa-calendar-alt mr-1"></i> Daftar Agenda
                </a>
                <a class="collapse-item" href="{{ route('staff.agenda.create') }}">
                    <i class="fas fa-fw fa-plus mr-1"></i> Tambah Agenda
                </a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Informasi Dropdown -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInformasi" aria-expanded="false" aria-controls="collapseInformasi">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Informasi Admin</span>
            <i class="fas fa-angle-down ml-2"></i>
        </a>
        <div id="collapseInformasi" class="collapse" aria-labelledby="headingInformasi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Informasi:</h6>
                <a class="collapse-item" href="{{ route('staff.informasi.index') }}">
                    <i class="fas fa-fw fa-list mr-1"></i> Daftar Informasi
                </a>
                <a class="collapse-item" href="{{ route('staff.informasi.create') }}">
                    <i class="fas fa-fw fa-plus mr-1"></i> Tambah Informasi
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-globe fa-sm fa-fw mr-2 text-gray-400"></i>
            Dashboard Website
        </a>
    </li>
    <!-- Tambah menu lain di sini -->
</ul>
