<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Portal Fakultas</title>
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
        @include('staff.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                {{-- Navbar --}}
                @include('staff.partials.navbar')
                {{-- Content --}}
                <div class="container-fluid mt-4">
                    @include('admin.partials.alerts')
                    @yield('content')
                </div>
            </div>
            {{-- Footer --}}
            <footer class="sticky-footer bg-white py-3 text-center">
                <span>&copy; Portal Fakultas {{ date('Y') }}</span>
            </footer>
        </div>
    </div>
    <!-- SB Admin 2 Scripts -->
    <script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/comment-enhancements.js') }}"></script>
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
    @yield('scripts')
</body>
</html>
