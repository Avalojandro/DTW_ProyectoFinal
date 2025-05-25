@extends('backend.layouts.admin')

@section('title', $movie->title)
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-0">{{ $movie->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('movies.index') }}">Películas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            @can('agregar-pelicula')
            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil me-1"></i> Editar
            </a>
            @endcan
            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                        onclick="return confirm('¿Estás seguro de eliminar esta película?')">
                    <i class="bi bi-trash me-1"></i> Eliminar
                </button>
            </form>
            <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-12 mb-4">
            <div class="cinema-screen">
                <div class="screen-content">
                    @if($movie->image_path)
                        <div class="film-strip">
                            <div class="film-perforations"></div>
                            <img src="{{ asset('storage/'.$movie->image_path) }}"
                                 class="img-fluid w-100 movie-poster"
                                 alt="{{ $movie->title }}"
                                 style="max-height: 60vh; object-fit: contain;">
                            <div class="film-perforations"></div>
                        </div>
                    @else
                        <div class="no-image-placeholder">
                            <i class="bi bi-film"></i>
                            <span>No hay imagen disponible</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0">Calificación</h3>
                        <div class="rating-display">
                            <div class="stars text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($movie->rating / 2))
                                        <i class="bi bi-star-fill"></i>
                                    @elseif($i == ceil($movie->rating / 2) && $movie->rating % 2 >= 0.5)
                                        <i class="bi bi-star-half"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="rating-value ms-2">
                                <span class="fs-3 fw-bold">{{ number_format($movie->rating, 1) }}</span>
                                <span class="text-muted">/10</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-2">Año de Lanzamiento</h3>
                        <p class="fs-4">{{ $movie->year }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-2">Sinopsis</h3>
                        <p class="fs-5">{{ $movie->description }}</p>
                    </div>

                    <div class="mt-auto pt-4 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="bi bi-calendar-plus me-1"></i>
                                    Creado: {{ $movie->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <small class="text-muted">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    Actualizado: {{ $movie->updated_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cinema-screen {
        position: relative;
        max-width: 900px;
        margin: 2rem auto;
        padding: 25px;
        background: #111;
        border-radius: 15px;
        box-shadow:
            0 0 40px rgba(0, 0, 0, 0.8),
            inset 0 0 50px rgba(255, 255, 255, 0.1);
        border: 2px solid #333;
    }

    .screen-content {
        border: 15px solid #000;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        background: #000;
    }

    .film-strip {
        position: relative;
        padding: 30px 50px;
        background: #000;
    }

    .film-perforations {
        height: 25px;
        background: repeating-linear-gradient(
            to right,
            #000,
            #000 8px,
            #fff 8px,
            #fff 16px
        );
        margin: 10px 0;
    }

    .no-image-placeholder {
        height: 500px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #111;
        color: #6c757d;
        border: 2px dashed #333;
    }

    .no-image-placeholder i {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        opacity: 0.7;
        color: #444;
    }

    .rating-display {
        display: flex;
        align-items: center;
        background: rgba(0, 0, 0, 0.1);
        padding: 10px 15px;
        border-radius: 50px;
    }

    .stars {
        font-size: 1.8rem;
        letter-spacing: 2px;
    }

    .card {
        border: none;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.95);
    }

    .movie-poster {
        transition: transform 0.5s ease;
    }

    .movie-poster:hover {
        transform: scale(1.02);
    }
</style>
@endsection