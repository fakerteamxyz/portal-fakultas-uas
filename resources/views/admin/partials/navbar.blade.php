<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" title="Toggle Sidebar">
        <i class="fa fa-bars"></i>
    </button>
    
    <!-- Sidebar Toggle (Desktop) -->
    <button id="sidebarToggle" class="btn btn-link rounded-circle mr-3 d-none d-md-inline-block" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar">
        <i class="fa fa-bars"></i>
    </button>
    
    <ul class="navbar-nav ml-auto">
        <!-- Notification Dropdown -->
        <li class="nav-item dropdown no-arrow mx-1">
            @php
                $unreadCommentsCount = \App\Models\Komentar::where('is_read', false)->count();
            @endphp
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-comments fa-fw"></i>
                @if($unreadCommentsCount > 0)
                <span class="badge badge-danger badge-counter">{{ $unreadCommentsCount }}</span>
                @endif
            </a>
            <!-- Dropdown - Notifications -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Komentar Terbaru
                </h6>
                @foreach(\App\Models\Komentar::with('user')->where('is_read', false)->latest()->take(5)->get() as $comment)
                <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.komentar.index') }}">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-comment text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{ $comment->created_at->format('d M Y, H:i') }}</div>
                        <span class="font-weight-bold">{{ $comment->user->name }}</span>: {{ \Illuminate\Support\Str::limit($comment->isi, 50) }}
                    </div>
                </a>
                @endforeach
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.komentar.index') }}">Lihat Semua Komentar</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <i class="fas fa-user-circle fa-lg"></i>
            </a>
            <!-- Dropdown - User Information -->
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
