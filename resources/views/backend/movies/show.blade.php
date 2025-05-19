@extends('backend.layouts.admin')

@section('title', $movie->title)
@section('content')
<div class="container py-5 fade-in">
    <!-- Efecto de aplausos mejorado -->
    <div class="applause-overlay" id="applauseOverlay">
        @for ($i = 0; $i < 20; $i++)
            <div class="applause-icon" style="
                left: {{ rand(5, 95) }}%;
                top: {{ rand(5, 95) }}%;
                animation-delay: {{ rand(0, 80)/100 }}s;
                font-size: {{ rand(3, 8) }}rem;
                opacity: {{ rand(5, 10)/10 }};
            ">👏</div>
        @endfor
    </div>

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
        <!-- Portada con efectos de cine premium -->
        <div class="col-lg-12 mb-4">
            <div class="cinema-screen">
                <div class="cinema-lights left-lights"></div>
                <div class="cinema-lights right-lights"></div>

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

        <!-- Detalles -->
        <div class="col-lg-12">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <!-- Rating -->
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

                    <!-- Año -->
                    <div class="mb-4">
                        <h3 class="mb-2">Año de Lanzamiento</h3>
                        <p class="fs-4">{{ $movie->year }}</p>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <h3 class="mb-2">Sinopsis</h3>
                        <p class="fs-5">{{ $movie->description }}</p>
                    </div>

                    <!-- Metadata -->
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
    /* ============ EFECTOS DE CINE MEJORADOS ============ */
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
        box-shadow: inset 0 0 100px rgba(255, 255, 255, 0.05);
    }

    /* Efecto de reflejo en la pantalla */
    .screen-content::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 30%;
        background: linear-gradient(
            to bottom,
            rgba(255, 255, 255, 0.1) 0%,
            transparent 100%
        );
        pointer-events: none;
    }

    .cinema-lights {
        position: absolute;
        top: 0;
        width: 25px;
        height: 100%;
        background: repeating-linear-gradient(
            90deg,
            #ff0000,
            #ff0000 5px,
            #ff4500 5px,
            #ff4500 10px
        );
        opacity: 0.7;
        animation: lightFlicker 3s infinite alternate;
        box-shadow: 0 0 20px rgba(255, 69, 0, 0.7);
    }

    @keyframes lightFlicker {
        0%, 100% {
            opacity: 0.7;
            box-shadow: 0 0 20px rgba(255, 69, 0, 0.7);
        }
        50% {
            opacity: 0.4;
            box-shadow: 0 0 30px rgba(255, 69, 0, 0.9);
        }
    }

    /* Rollo de película mejorado */
    .film-strip {
        position: relative;
        padding: 30px 50px;
        background: #000;
        background-image:
            linear-gradient(to right, #333 1px, transparent 1px),
            linear-gradient(to bottom, #333 1px, transparent 1px);
        background-size: 20px 20px;
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
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    /* Aplausos mejorados */
    .applause-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        pointer-events: none;
    }

    .applause-icon {
        position: absolute;
        animation: bounce 1s infinite alternate;
        filter: drop-shadow(0 0 5px rgba(255, 215, 0, 0.7));
    }

    @keyframes bounce {
        0% { transform: translateY(0) scale(1) rotate(-10deg); }
        100% { transform: translateY(-30px) scale(1.3) rotate(10deg); }
    }

    /* ============ ESTILOS EXISTENTES MEJORADOS ============ */
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

    .fade-in {
        animation: fadeIn 1s ease-out forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Efecto especial para el poster */
    .movie-poster {
        transition: transform 0.5s ease, box-shadow 0.5s ease;
    }

    .movie-poster:hover {
        transform: scale(1.02);
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
    }
</style>

<script>
    // Efectos mejorados al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar aplausos si la película está vista
        @if($movie->status == 'watched')
            setTimeout(() => {
                const overlay = document.getElementById('applauseOverlay');
                if (overlay) {
                    overlay.style.display = 'flex';

                    // Efecto de sonido (opcional)
                    try {
                        const audio = new Audio('https://assets.mixkit.co/sfx/preview/mixkit-audience-clapping-strongly-476.mp3');
                        audio.volume = 0.4;
                        audio.play();
                    } catch (e) {
                        console.log("El audio requiere interacción del usuario");
                    }

                    setTimeout(() => {
                        overlay.style.display = 'none';
                    }, 4000);
                }
            }, 1500); // Mayor delay para mayor dramatismo
        @endif

        // Activar aplausos al cambiar estado a "Vista"
        const statusSelect = document.querySelector('#status');
        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                if (this.value === 'watched') {
                    const overlay = document.getElementById('applauseOverlay');
                    if (overlay) {
                        overlay.style.display = 'flex';
                        setTimeout(() => {
                            overlay.style.display = 'none';
                        }, 4000);
                    }
                }
            });
        }

        // Efecto de iluminación al pasar el mouse
        const moviePoster = document.querySelector('.movie-poster');
        if (moviePoster) {
            moviePoster.addEventListener('mouseenter', () => {
                const lights = document.querySelectorAll('.cinema-lights');
                lights.forEach(light => {
                    light.style.opacity = '0.9';
                    light.style.boxShadow = '0 0 30px rgba(255, 69, 0, 0.9)';
                });
            });

            moviePoster.addEventListener('mouseleave', () => {
                const lights = document.querySelectorAll('.cinema-lights');
                lights.forEach(light => {
                    light.style.opacity = '0.7';
                    light.style.boxShadow = '0 0 20px rgba(255, 69, 0, 0.7)';
                });
            });
        }
    });
</script>
@endsection
