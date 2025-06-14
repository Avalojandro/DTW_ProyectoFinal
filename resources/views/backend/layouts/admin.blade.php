<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="{{ asset('images/fav-icon-cine-catalogo.ico') }}" rel="icon" type="image/x-icon">

    @stack('styles')

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background-color: #f8f9fa;
            display: flex;
        }

        .main-wrapper {
            display: flex;
            flex: 1;
            height: 100vh;
        }

        .admin-sidebar {
            background: #343a40;
            color: white;
            width: 250px;
            display: flex;
            flex-direction: column;
        }

        .admin-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .nav-link {
            padding: 10px 15px;
            margin-bottom: 5px;
            border-radius: 4px;
        }

        .nav-link:hover {
            background-color: #495057;
        }

        .nav-link.active {
            background-color: #007bff;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="admin-sidebar p-3">
            <h4 class="text-center mb-4">
                <a href="{{ route('movies.index') }}"
                    class="d-flex align-items-center justify-content-center text-decoration-none text-white">
                    <i class="bi bi-camera-reels me-2"></i> CineCatálogo
                </a>
            </h4>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('movies.index') ? 'active' : '' }}"
                        href="{{ route('movies.index') }}">
                        <i class="bi bi-film me-2"></i> Películas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('tmdb.index') ? 'active' : '' }}"
                        href="{{ route('tmdb.index') }}">
                        <i class="bi bi-globe2 me-2"></i> Catálogo Mundial
                    </a>
                </li>
                @can('agregar-pelicula')
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('movies.create') ? 'active' : '' }}"
                            href="{{ route('movies.create') }}">
                            <i class="bi bi-plus-circle me-2"></i> Nueva Película
                        </a>
                    </li>
                @endcan
                @can('agregar-pelicula')
                    <li class="nav-item">
                        <a class=" text-nowrap nav-link text-white {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard.index') }}">
                            <i class="bi bi-plus-circle me-2 text-nowrap"></i>
                            Panel de administración
                        </a>
                    </li>
                @endcan
            </ul>

            <div class="mt-auto pt-3">
                <a href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();"
                    class="btn btn-danger d-flex align-items-center justify-content-center"
                    style="width: 45px; height: 45px; border-radius: 8px;" title="Cerrar sesión">
                    <i class="bi bi-box-arrow-right"></i>
                </a>

                <form id="sidebar-logout-form" action="{{ route('admin.logout') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="admin-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>