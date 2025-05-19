@extends('layouts.app')

@section('title', 'Bienvenido a CineCatálogo')
@section('content')

<!-- Cortinillas y luces de teatro -->
<div class="cinema-curtain left-curtain"></div>
<div class="cinema-curtain right-curtain"></div>
<div class="theater-spotlights"></div>

<div class="welcome-hero">
    <div class="container text-center py-5">
        <h1 class="display-3 fw-bold mb-4">Bienvenido a CineCatálogo</h1>
        <p class="lead mb-5">Tu colección personal de películas favoritas</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('movies.index') }}" class="btn btn-primary btn-lg px-4">
                <i class="bi bi-film me-2"></i> Explorar Catálogo
            </a>
            @can('agregar-peliculas')
            <a href="{{ route('movies.create') }}" class="btn btn-outline-light btn-lg px-4">
                <i class="bi bi-plus-circle me-2"></i> Agregar Película
            </a>
            @endcan
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-collection-play fs-1 text-primary mb-3"></i>
                    <h3 class="h4">Catálogo Completo</h3>
                    <p>Organiza todas tus películas en un solo lugar con información detallada.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-search fs-1 text-primary mb-3"></i>
                    <h3 class="h4">Búsqueda Avanzada</h3>
                    <p>Encuentra rápidamente tus películas por título, género o estado.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-star fs-1 text-primary mb-3"></i>
                    <h3 class="h4">Calificaciones</h3>
                    <p>Califica tus películas y lleva un registro de las que has visto.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .welcome-hero {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://via.placeholder.com/1920x1080');
        background-size: cover;
        background-position: center;
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
@endsection
