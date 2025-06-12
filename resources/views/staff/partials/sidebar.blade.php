<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: var(--dark); border-right: 6px solid var(--primary);">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#" style="background-color: var(--primary); border-bottom: 4px solid white;">
        <div class="sidebar-brand-icon" style="transform: rotate(-5deg);">
            <img src="{{ asset('image/logounp.png') }}" alt="Logo" style="height:40px; border: 3px solid white; padding: 2px;">
        </div>
        <div class="sidebar-brand-text mx-3" style="font-family: 'Outfit', sans-serif; font-weight: 900; letter-spacing: 1px;">Staff Fakultas</div>
    </a>
    <hr class="sidebar-divider" style="border-color: var(--primary); opacity: 1; border-width: 2px;">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('staff.dashboard') }}" style="margin-bottom: 5px; border-left: 4px solid transparent; transition: all 0.3s;">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-weight: 700; letter-spacing: 0.5px;">Dashboard</span>
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
