<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Portal Fakultas') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Bootstrap and FontAwesome -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        
        <!-- Custom Styles -->
        <style>
            body {
                background: linear-gradient(120deg, #f8f9fa 0%, #e9ecef 100%);
                min-height: 100vh;
            }
            .auth-card {
                border: none;
                border-radius: 1rem;
                box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
                transition: transform 0.3s, box-shadow 0.3s;
            }
            .auth-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
            }
            .auth-header {
                background: linear-gradient(120deg, #4e73df 60%, #36b9cc 100%);
                color: white;
                border-radius: 1rem 1rem 0 0;
                padding: 1.5rem;
                text-align: center;
            }
            .btn-primary {
                background: linear-gradient(120deg, #4e73df 60%, #36b9cc 100%);
                border: none;
                padding: 0.6rem 1.5rem;
            }
            .btn-link {
                color: #4e73df;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top mb-4">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary" href="/">
                    <img src="{{ asset('sb-admin-2/img/logo.png') }}" alt="Logo" style="height:40px;"> Portal Fakultas
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                </div>
            </div>
        </nav>
        
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        
        <footer class="bg-primary text-white text-center py-4 mt-5">
            <div class="container">
                <img src="{{ asset('sb-admin-2/img/logo.png') }}" alt="Logo" style="height:32px;"> <br>
                <span class="fw-bold">Portal Fakultas</span> &copy; {{ date('Y') }}
            </div>
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
