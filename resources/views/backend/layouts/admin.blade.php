<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    @stack('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .admin-content {
            padding: 20px;
            width: 100%;
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
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="admin-sidebar text-white p-3" style="width: 250px;">
            <h4 class="text-center mb-4">CineCatálogo</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('movies.index') ? 'active' : '' }}" href="{{ route('movies.index') }}">
                        <i class="bi bi-film me-2"></i> Películas
                    </a>
                </li>
                @can('agregar-pelicula')
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('movies.create') ? 'active' : '' }}" href="{{ route('movies.create') }}">
                        <i class="bi bi-plus-circle me-2"></i> Nueva Película
                    </a>
                </li>
                @endcan
            </ul>
        </div>

        <!-- Main content -->
        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
