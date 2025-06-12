<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Portal Fakultas') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;900&display=swap" rel="stylesheet">
        
        <!-- Bootstrap and FontAwesome -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        
        <!-- Custom Styles -->
        <style>
            :root {
                --primary: #ff5252;
                --secondary: #ffde59;
                --accent: #4aff8b;
                --dark: #121212;
                --light: #f5f5f5;
            }
            
            body {
                font-family: 'Outfit', sans-serif;
                background-color: var(--light);
                color: var(--dark);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }
            
            .auth-card {
                background-color: white;
                border: 6px solid var(--dark);
                box-shadow: 12px 12px 0 var(--dark);
                border-radius: 2px;
                transition: transform 0.2s, box-shadow 0.2s;
                margin-top: 2rem;
                position: relative;
                overflow: hidden;
            }
            
            .auth-card::before {
                content: '';
                position: absolute;
                width: 100px;
                height: 100px;
                background-color: var(--accent);
                border: 4px solid var(--dark);
                top: -50px;
                right: -50px;
                transform: rotate(25deg);
                z-index: 1;
            }
            
            .auth-header {
                background-color: var(--secondary);
                color: var(--dark);
                padding: 2rem;
                position: relative;
                z-index: 2;
                border-bottom: 6px solid var(--dark);
            }
            
            .neo-btn {
                background-color: var(--primary);
                color: white;
                font-weight: 700;
                padding: 0.6rem 1.5rem;
                border: 4px solid var(--dark);
                box-shadow: 6px 6px 0 var(--dark);
                border-radius: 2px;
                transition: transform 0.1s, box-shadow 0.1s;
                position: relative;
                z-index: 5;
                text-decoration: none;
                display: inline-block;
            }
            
            .neo-btn:hover {
                transform: translate(2px, 2px);
                box-shadow: 4px 4px 0 var(--dark);
                color: white;
            }
            
            .neo-btn:active {
                transform: translate(6px, 6px);
                box-shadow: 0px 0px 0 var(--dark);
                color: white;
            }
            
            .neo-btn-secondary {
                background-color: var(--secondary);
                color: var(--dark);
            }
            
            .neo-btn-secondary:hover {
                color: var(--dark);
            }
            
            .neo-btn-accent {
                background-color: var(--accent);
                color: var(--dark);
            }
            
            .neo-btn-accent:hover {
                color: var(--dark);
            }
            
            .neo-form-group {
                margin-bottom: 1.5rem;
            }
            
            .neo-label {
                font-weight: 700;
                margin-bottom: 0.5rem;
                display: block;
            }
            
            .neo-input-group {
                position: relative;
                display: flex;
            }
            
            .neo-form-control {
                border: 4px solid var(--dark);
                border-radius: 2px;
                padding: 0.8rem 1.2rem;
                font-weight: 500;
                width: 100%;
                background: white;
                font-size: 1.05rem;
                height: auto;
                min-height: 58px;
                box-sizing: border-box;
            }
            
            .neo-form-control:focus {
                outline: none;
                box-shadow: 6px 6px 0 rgba(18, 18, 18, 0.2);
                background-color: #fff;
                color: var(--dark);
            }
            
            .neo-input-group {
                position: relative;
                display: flex;
                width: 100%;
                margin-bottom: 0.5rem;
            }
            
            .neo-input-icon {
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 50px;
                background-color: var(--secondary);
                border-right: 4px solid var(--dark);
                font-size: 1.2rem;
                z-index: 1;
            }
            
            .neo-input-with-icon {
                padding: 0.8rem 1.2rem 0.8rem 60px;
                text-indent: 0;
                letter-spacing: 0.5px;
                color: var(--dark);
                overflow: visible;
                text-overflow: ellipsis;
            }
            
            .neo-navbar {
                background-color: white;
                border-bottom: 4px solid var(--dark);
                padding: 1rem;
            }
            .errors-list {
                margin-top: 0.5rem;
                color: var(--primary);
                font-weight: 600;
            }
            
            ::placeholder {
                color: rgba(18, 18, 18, 0.5);
                opacity: 1;
                font-size: 0.95rem;
            }
            
            :-ms-input-placeholder {
                color: rgba(18, 18, 18, 0.5);
                font-size: 0.95rem;
            }
            
            ::-ms-input-placeholder {
                color: rgba(18, 18, 18, 0.5);
                font-size: 0.95rem;
            }
            
            /* Perbaikan untuk input field */
            input.neo-form-control {
                display: block;
                width: 100%;
                padding-left: 60px;
            }
            
            /* Pastikan text tidak terpotong pada browser mobile */
            @media (max-width: 576px) {
                .neo-input-with-icon {
                    padding-left: 55px;
                    font-size: 0.95rem;
                }
                
                .neo-input-icon {
                    width: 45px;
                }
            }
            
            .neo-check {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 1rem;
            }
            
            .neo-check input[type="checkbox"] {
                width: 20px;
                height: 20px;
                border: 3px solid var(--dark);
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                border-radius: 2px;
                background-color: white;
                cursor: pointer;
                position: relative;
            }
            
            .neo-check input[type="checkbox"]:checked {
                background-color: var(--accent);
            }
            
            .neo-check input[type="checkbox"]:checked::after {
                content: '✓';
                font-size: 16px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: var(--dark);
                font-weight: bold;
            }
            
            .neo-check label {
                font-weight: 600;
                margin-bottom: 0;
                cursor: pointer;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="navbar navbar-expand-lg neo-navbar sticky-top mb-4">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="/">
                    <img src="{{ asset('sb-admin-2/img/logo.png') }}" alt="Logo" style="height:48px; border: 3px solid var(--dark); margin-right:15px;"> 
                    <span style="font-size:1.3rem; line-height:1.1; font-weight:900;">PORTAL<br>FAKULTAS TEKNIK</span>
                </a>
                <div class="d-flex gap-2">
                    @if(Route::has('login') && Route::currentRouteName() != 'login')
                        <a href="{{ route('login') }}" class="neo-btn">LOGIN</a>
                    @elseif(Route::has('register') && Route::currentRouteName() != 'register')
                        <a href="{{ route('register') }}" class="neo-btn neo-btn-accent">DAFTAR</a>
                    @endif
                    <a href="/" class="neo-btn neo-btn-secondary">
                        <i class="bi bi-house-door"></i>
                    </a>
                </div>
            </div>
        </nav>
        
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div style="position:absolute; width:120px; height:120px; background:var(--primary); border:4px solid var(--dark); transform:rotate(35deg); top:40%; right:-50px; z-index:-1;"></div>
                    <div style="position:absolute; width:80px; height:80px; background:var(--secondary); border:4px solid var(--dark); transform:rotate(15deg); top:30%; left:-20px; z-index:-1;"></div>
                    {{ $slot }}
                </div>
            </div>
        </div>
        
        <footer class="text-center py-5 mt-5" style="background-color:var(--dark); color:white; position:relative; overflow:hidden;">
            <div style="position:absolute; width:100px; height:100px; background:var(--primary); border:4px solid white; transform:rotate(45deg); top:-50px; right:10%;"></div>
            <div style="position:absolute; width:80px; height:80px; background:var(--accent); border:4px solid white; transform:rotate(15deg); bottom:-30px; left:15%;"></div>
            
            <div class="container position-relative">
                <div style="background:white; display:inline-block; border:4px solid white; padding:0.5rem; margin-bottom:1rem; transform:rotate(-2deg);">
                    <img src="{{ asset('sb-admin-2/img/logo.png') }}" alt="Logo" style="height:48px;">
                </div>
                <div>
                    <h3 class="fw-bold mb-3" style="font-size:2rem; text-transform:uppercase; letter-spacing:2px;">Portal Fakultas</h3>
                    <p class="mb-3">Universitas Negeri Padang</p>
                    <div style="border-top:1px solid rgba(255,255,255,0.2); padding-top:1.5rem; margin-top:1.5rem;">
                        <span class="fw-bold">&copy; {{ date('Y') }}</span>
                    </div>
                </div>
            </div>
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
