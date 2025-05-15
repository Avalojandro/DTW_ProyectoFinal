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

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

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
            --cinema-red: #8B0000;
            --cinema-gold: #FFD700;
            --curtain-shadow: rgba(139, 0, 0, 0.8);
        }

        body {
            background-color: var(--light-color);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* ============ NUEVA CORTINA DE CINE MEJORADA ============ */
        .cinema-curtain {
            position: fixed;
            top: 0;
            width: 50%;
            height: 100vh;
            background: linear-gradient(to bottom,
                var(--cinema-red) 0%,
                #6B0000 20%,
                #4B0000 50%,
                #6B0000 80%,
                var(--cinema-red) 100%);
            z-index: 9999;
            transition: transform 1.8s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            box-shadow:
                0 0 25px var(--curtain-shadow),
                inset 0 -50px 100px rgba(0, 0, 0, 0.5);
            transform-origin: top center;
        }

        .cinema-curtain::after {
            content: '';
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                180deg,
                rgba(0, 0, 0, 0.1),
                rgba(0, 0, 0, 0.1) 1px,
                transparent 1px,
                transparent 3px
            );
        }

        .left-curtain {
            left: 0;
            transform: translateX(0) rotateY(0deg);
            border-right: 3px solid #500000;
        }

        .right-curtain {
            right: 0;
            transform: translateX(0) rotateY(0deg);
            border-left: 3px solid #500000;
        }

        body.loaded .left-curtain {
            transform: translateX(-105%) rotateY(-15deg);
        }

        body.loaded .right-curtain {
            transform: translateX(105%) rotateY(15deg);
        }

        /* Borlas decorativas */
        .curtain-tassels {
            position: fixed;
            top: 50%;
            width: 30px;
            height: 100px;
            background: linear-gradient(to bottom,
                var(--cinema-gold),
                #D4AF37,
                var(--cinema-gold));
            z-index: 10000;
            transform: translateY(-50%);
            border-radius: 5px;
            box-shadow: 0 0 10px gold;
            transition: opacity 0.5s ease 1.5s;
        }

        .left-tassels {
            left: calc(50% - 15px);
            clip-path: polygon(0% 0%, 100% 15%, 100% 85%, 0% 100%);
        }

        .right-tassels {
            right: calc(50% - 15px);
            clip-path: polygon(0% 15%, 100% 0%, 100% 100%, 0% 85%);
        }

        body.loaded .curtain-tassels {
            opacity: 0;
        }

        /* Focos de teatro */
        .theater-spotlights {
            position: fixed;
            top: 0;
            width: 100%;
            height: 100vh;
            pointer-events: none;
            z-index: 9998;
            background: radial-gradient(
                ellipse at 20% 10%,
                transparent 60%,
                rgba(255, 215, 0, 0.1) 80%,
                transparent 100%
            ), radial-gradient(
                ellipse at 80% 10%,
                transparent 60%,
                rgba(255, 69, 0, 0.1) 80%,
                transparent 100%
            );
            opacity: 0;
            transition: opacity 2s;
        }

        body.loaded .theater-spotlights {
            opacity: 1;
        }

        /* ============ ESTILOS EXISTENTES ============ */
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
            opacity: 0;
            transition: opacity 1s ease;
        }

        body.loaded main {
            opacity: 1;
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
    </style>
</head>
<body>
    <!-- Efectos de Cine Mejorados -->
    <div class="cinema-curtain left-curtain"></div>
    <div class="cinema-curtain right-curtain"></div>
    <div class="curtain-tassels left-tassels"></div>
    <div class="curtain-tassels right-tassels"></div>
    <div class="theater-spotlights"></div>
    <div class="projector-light"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-camera-reels me-2"></i>
                CineCatálogo
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('movies.index') ? 'active' : '' }}"
                           href="{{ route('movies.index') }}">
                            <i class="bi bi-film me-1"></i> Películas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('movies.create') ? 'active' : '' }}"
                           href="{{ route('movies.create') }}">
                            <i class="bi bi-plus-circle me-1"></i> Nueva Película
                        </a>
                    </li>
                </ul>

                <form class="d-flex ms-auto" action="{{ route('movies.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar películas..."
                               name="search" value="{{ request('search') }}">
                        <button class="btn btn-outline-light" type="submit">
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
                <div class="col-md-6">
                    <h5><i class="bi bi-camera-reels me-2"></i>CineCatálogo</h5>
                    <p class="text-muted">Tu catálogo personal de películas favoritas.</p>
                </div>
                <div class="col-md-3">
                    <h5>Enlaces</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('movies.index') }}" class="text-white">Películas</a></li>
                        <li><a href="{{ route('movies.create') }}" class="text-white">Agregar Película</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-envelope me-2"></i> contacto@cinecatalogo.com</li>
                        <li><i class="bi bi-github me-2"></i> GitHub</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <small class="text-muted">© {{ date('Y') }} CineCatálogo. Todos los derechos reservados.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Efecto cortinillas premium al cargar
            setTimeout(() => {
                document.body.classList.add('loaded');

                // Sonido de cortinilla (opcional)
                try {
                    const audio = new Audio('https://assets.mixkit.co/sfx/preview/mixkit-theater-curtain-1293.mp3');
                    audio.volume = 0.3;
                    audio.play();
                } catch (e) {
                    console.log("El audio requiere interacción del usuario");
                }
            }, 800);

            // 2. Auto-ocultar notificaciones
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert-notification');
                alerts.forEach(alert => {
                    new bootstrap.Alert(alert).close();
                });
            }, 5000);

            // 3. Confirmación antes de eliminar
            document.querySelectorAll('form[action*="destroy"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('¿Estás seguro de eliminar este registro?')) {
                        e.preventDefault();
                    }
                });
            });

            // 4. Tooltips
            [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                .forEach(el => new bootstrap.Tooltip(el));

            // 5. Efecto de aplausos
            const showApplause = () => {
                const overlay = document.createElement('div');
                overlay.className = 'applause-overlay';

                for (let i = 0; i < 15; i++) {
                    const icon = document.createElement('div');
                    icon.className = 'applause-icon';
                    icon.innerHTML = '👏';
                    icon.style.cssText = `
                        left: ${Math.random() * 80 + 10}%;
                        top: ${Math.random() * 80 + 10}%;
                        animation-delay: ${Math.random() * 0.5}s;
                        font-size: ${Math.random() * 3 + 3}rem;
                    `;
                    overlay.appendChild(icon);
                }

                document.body.appendChild(overlay);
                setTimeout(() => overlay.remove(), 3000);
            };

            // Activar aplausos si es necesario
            @if(session('show_applause'))
                setTimeout(showApplause, 1000);
            @endif
        });
    </script>

    @stack('scripts')
</body>
</html>
