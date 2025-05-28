<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen - Portal Fakultas</title>
    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom Styles -->
    <link href="{{ asset('css/custom-admin.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        {{-- Sidebar --}}
        @include('dosen.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                {{-- Navbar --}}
                @include('dosen.partials.navbar')
                {{-- Content --}}
                <div class="container-fluid mt-4">
                    @include('dosen.partials.alerts')
                    @yield('content')
                </div>
            </div>
            {{-- Footer --}}
            <footer class="sticky-footer bg-white py-3 text-center">
                <span>Copyright © Portal Fakultas {{ date('Y') }}</span>
            </footer>
        </div>
    </div>
    <!-- SB Admin 2 Scripts -->
    <script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/comment-enhancements.js') }}"></script>
    <!-- Auto-dismiss alerts after 5 seconds -->
    <script>
        $(document).ready(function() {
            // Auto dismiss alerts after 5 seconds
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
    @yield('scripts')

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Apakah Anda yakin ingin logout dari dashboard?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
