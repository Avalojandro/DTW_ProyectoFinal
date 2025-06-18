@extends('layouts.app')

@section('title', 'Bienvenido a CineCatálogo')
@section('content')

<div class="welcome-hero">
    <div class="container text-center py-5">
         <!--Botón para evento Click-->
        <button id="miBoton" class="btn btn-warning">Haz clic aquí</button>
        <h1 class="display-3 fw-bold mb-4">Bienvenido a CineCatálogo</h1>
        <p class="lead mb-5">Tu colección personal de películas favoritas</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('movies.index') }}" class="btn btn-primary btn-lg px-4">
                <i class="bi bi-film me-2"></i> Explorar Catálogo
            </a>
        </div>
    </div>
</div>

<div class="col-md-6 offset-md-3 mt-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-center mb-3">Filtrar por género</h5>
            <form>
                <div class="mb-3">
                    <label for="genero" class="form-label">Géneros:</label>
                    <select id="genero" class="form-select">
                        <option value="">Elige una opción</option>
                        <option value="Estrenos">Estrenos</option>
                        <option value="Aventura">Aventura</option>
                        <option value="Acción">Acción</option>
                        <option value="Comedia">Comedia</option>
                        <option value="Drama">Drama</option>
                        <option value="Terror">Terror</option>
                        <option value="Romance">Romance</option>
                    </select>
                </div>
            </form>
            <p id="mensajeGenero" class="text-center text-primary fw-semibold mt-3"></p>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm tarjeta-interactiva">
                <div class="card-body text-center">
                    <i class="bi bi-collection-play fs-1 text-primary mb-3"></i>
                    <h3 class="h4">Catálogo Completo</h3>
                    <p>Organiza todas tus películas en un solo lugar con información detallada.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm tarjeta-interactiva">
                <div class="card-body text-center">
                    <i class="bi bi-search fs-1 text-primary mb-3"></i>
                    <h3 class="h4">Búsqueda Avanzada</h3>
                    <p>Encuentra rápidamente tus películas por título, género o estado.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm tarjeta-interactiva">
                <div class="card-body text-center">
                    <i class="bi bi-star fs-1 text-primary mb-3"></i>
                    <h3 class="h4">Calificaciones</h3>
                    <p>Califica tus películas y lleva un registro de las que has visto.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Formulario-->
<div class="container my-5">
    <h2 class="text-center mb-4">Contáctanos</h2>
    <form id="miFormulario" class="mx-auto" style="max-width: 600px;">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" id="nombre" class="form-control" placeholder="Escribe tu nombre">
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" id="correo" class="form-control" placeholder="ejemplo@correo.com">
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Dejanos un mensaje</label>
            <textarea id="mensaje" class="form-control" rows="4" placeholder="Escribenos un mensaje"></textarea>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
    <div id="resultado" class="mt-3 text-center fw-semibold"></div>
</div>


<style>
    .welcome-hero {
        background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1524712245354-2c4e5e7121c0?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fGNpbmVtYXxlbnwwfHwwfHx8MA%3D%3D');
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