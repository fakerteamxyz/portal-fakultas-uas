<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Portal Fakultas') }}</title>

        {{-- Google Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;900&display=swap" rel="stylesheet">
        
        {{-- Bootstrap 5 --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        {{-- Custom Mahasiswa Styles --}}
        <link href="{{ asset('css/custom-mahasiswa.css') }}" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Outfit', sans-serif;
                background-color: var(--light);
            }
            
            .navbar.neo-navbar {
                background-color: var(--dark) !important;
                border-bottom: 5px solid var(--primary);
                padding: 1rem;
            }
            
            .navbar.neo-navbar .navbar-brand {
                font-weight: 900;
                color: white;
                letter-spacing: 1px;
            }
            
            .navbar.neo-navbar .nav-link {
                color: white;
                font-weight: 700;
                margin-right: 1.5rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                transition: color 0.3s;
            }
            
            .navbar.neo-navbar .nav-link:hover {
                color: var(--accent);
            }
            
            .neo-page-header {
                background-color: var(--accent);
                border-bottom: 5px solid var(--dark);
                padding: 1.5rem 0;
                margin-bottom: 2rem;
            }
            
            .neo-page-header h1 {
                font-weight: 900;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin: 0;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" style="background-color: var(--light);">
            @include('mahasiswa.layouts.navigation')

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/comment-enhancements.js') }}"></script>
        <script>
            // Auto dismiss alerts after 5 seconds
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    var alerts = document.querySelectorAll('.alert');
                    alerts.forEach(function(alert) {
                        var bsAlert = new bootstrap.Alert(alert);
                        setTimeout(function() {
                            bsAlert.close();
                        }, 5000);
                    });
                }, 500);
                
                // Track last time admin replies were checked
                if (document.querySelector('.information-detail-page')) {
                    localStorage.setItem('lastAdminReplyCheck', new Date().toISOString());
                }
            });
        </script>
    </body>
</html>