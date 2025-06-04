<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CineCatálogo Premium')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="{{ asset('images/fav-icon-cine-catalogo.ico') }}" rel="icon" type="image/x-icon">

    @stack('styles')

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --dark-color: #212529;
            --light-color: #f8f9fa;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }

        body {
            background-color: var(--light-color);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary-color);
        }

        .navbar-dark .navbar-brand {
            color: white;
        }

        main {
            flex: 1;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .movie-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 100%;
        }

        .movie-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .movie-img {
            height: 300px;
            object-fit: cover;
            width: 100%;
        }

        .no-image {
            height: 300px;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

        .rating-stars {
            color: var(--warning-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .alert-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1100;
            min-width: 300px;
        }

        .search-btn {
            transform: none !important;
            background-color: transparent !important;
            color: white !important;
            transition: background-color 0.3s ease, color 0.3s ease !important;
        }

        .search-btn:hover {
            background-color: #007bff !important;
            color: white !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <span class="navbar-brand d-flex align-items-center">
                <i class="bi bi-camera-reels me-2"></i>
                CineCatálogo
            </span>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <form class="d-flex ms-auto" action="{{ route('movies.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar películas..." name="search" value="{{ request('search') }}" style="box-shadow: none !important">
                        <button class="btn btn-outline-light search-btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="container">
            <!-- Notificaciones -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show alert-notification" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show alert-notification" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-5 mb-4 text-center text-md-start">
                    <h5><i class="bi bi-camera-reels me-2"></i>CineCatálogo</h5>
                    <p>Tu catálogo personal de películas y series favoritas.</p>
                </div>
                <div class="col-12 col-md-5 text-center text-md-start ms-md-auto">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-telephone me-2"></i> +503 2200 9000
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-envelope me-2"></i> contacto@cinecatalogo.com
                        </li>
                        <li class="mt-3">
                            <h6>Síguenos en redes:</h6>
                            <div class="social-icons mt-2 text-white d-flex justify-content-center justify-content-md-start" style="font-size: 1.5rem;">
                                <i class="bi bi-facebook me-3" aria-label="Facebook"></i>
                                <i class="bi bi-twitter-x me-3" aria-label="Twitter"></i>
                                <i class="bi bi-instagram me-3" aria-label="Instagram"></i>
                                <i class="bi bi-youtube me-3" aria-label="YouTube"></i>
                                <i class="bi bi-tiktok" aria-label="TikTok"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <small>© {{ date('Y') }} CineCatálogo. Todos los derechos reservados.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-ocultar notificaciones
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert-notification');
                alerts.forEach(alert => {
                    new bootstrap.Alert(alert).close();
                });
            }, 5000);

            // Confirmación antes de eliminar
            document.querySelectorAll('form[action*="destroy"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('¿Estás seguro de eliminar este registro?')) {
                        e.preventDefault();
                    }
                });
            });

            // Tooltips
            [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                .forEach(el => new bootstrap.Tooltip(el));
        });
    </script>

    @stack('scripts')
</body>
</html>
