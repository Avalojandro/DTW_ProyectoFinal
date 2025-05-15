@extends('backend.layouts.admin')

@section('title', 'Catálogo de Películas')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Catálogo de Películas</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">
                <i class="bi bi-house-door me-1"></i> Volver al Inicio
            </a>
            <a href="{{ route('movies.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Nueva Película
            </a>
        </div>
    </div>

    <!-- Filtros de Búsqueda -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('movies.index') }}" method="GET" id="filterForm">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Buscar por título</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Ej: Titanic..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="genre" class="form-label">Género</label>
                        <select name="genre" class="form-select">
                            <option value="">Todos los géneros</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                                    {{ $genre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label">Estado</label>
                        <select name="status" class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendientes</option>
                            <option value="watched" {{ request('status') == 'watched' ? 'selected' : '' }}>Vistas</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filtrar
                        </button>
                        <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary" title="Limpiar filtros">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Listado de Películas -->
    @if($movies->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($movies as $movie)
            <div class="col">
                <div class="card h-100 shadow-sm movie-card">
                    @if($movie->image_path)
                        <img src="{{ asset('storage/'.$movie->image_path) }}" class="card-img-top movie-image" alt="{{ $movie->title }}">
                    @else
                        <div class="no-image-placeholder">
                            <i class="bi bi-film"></i>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary">{{ $movie->genre }}</span>
                            <span class="text-muted">{{ $movie->year }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($movie->rating / 2))
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @elseif($i == ceil($movie->rating / 2) && $movie->rating % 2 >= 0.5)
                                        <i class="bi bi-star-half text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-warning"></i>
                                    @endif
                                @endfor
                                <small class="ms-1">{{ number_format($movie->rating, 1) }}</small>
                            </div>
                            <span class="badge bg-{{ $movie->status == 'watched' ? 'success' : 'warning' }}">
                                {{ $movie->status == 'watched' ? 'Vista' : 'Pendiente' }}
                            </span>
                        </div>

                        <p class="card-text text-truncate-3">{{ $movie->description }}</p>
                    </div>

                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('movies.show', $movie) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                            <a href="{{ route('movies.edit', $movie) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar esta película?')">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $movies->withQueryString()->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> No se encontraron películas con los filtros aplicados.
        </div>
    @endif
</div>

<style>
    .movie-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }

    .movie-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .movie-image {
        height: 300px;
        object-fit: cover;
        width: 100%;
    }

    .no-image-placeholder {
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        color: #6c757d;
        font-size: 3rem;
    }

    .text-truncate-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection
