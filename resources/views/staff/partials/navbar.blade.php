<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top" style="border-bottom: 5px solid var(--dark); box-shadow: 0 4px 0 var(--primary);">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn d-md-none" style="border: 3px solid var(--dark); border-radius: 0; margin-right: 1rem;">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-dark small" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">{{ Auth::user()->name }}</span>
                <img class="img-profile" src="{{ asset('image/logounp.png') }}" style="height:36px; border: 3px solid var(--dark); padding: 2px; transform: rotate(3deg);">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
