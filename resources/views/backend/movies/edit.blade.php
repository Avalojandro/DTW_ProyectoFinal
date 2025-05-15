@extends('backend.layouts.admin')

@section('title', 'Editar Película: ' . $movie->title)
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Editar: {{ $movie->title }}</h1>
        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Volver a Detalles
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('movies.update', $movie->id) }}" method="POST"
                  enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Título -->
                    <div class="col-md-6">
                        <label for="title" class="form-label">Título *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title', $movie->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">Por favor ingresa el título de la película.</div>
                        @enderror
                    </div>

                    <!-- Género -->
                    <div class="col-md-6">
                        <label for="genre" class="form-label">Género *</label>
                        <select class="form-select @error('genre') is-invalid @enderror" id="genre" name="genre" required>
                            <option value="">Seleccione un género</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre }}" {{ old('genre', $movie->genre) == $genre ? 'selected' : '' }}>
                                    {{ $genre }}
                                </option>
                            @endforeach
                        </select>
                        @error('genre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">Por favor selecciona un género.</div>
                        @enderror
                    </div>

                    <!-- Año -->
                    <div class="col-md-3">
                        <label for="year" class="form-label">Año *</label>
                        <select class="form-select @error('year') is-invalid @enderror" id="year" name="year" required>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ old('year', $movie->year) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">Por favor selecciona un año válido.</div>
                        @enderror
                    </div>

                    <!-- Calificación -->
                    <div class="col-md-3">
                        <label for="rating" class="form-label">Calificación *</label>
                        <input type="number" step="0.1" min="1" max="10"
                               class="form-control @error('rating') is-invalid @enderror"
                               id="rating" name="rating" value="{{ old('rating', $movie->rating) }}" required>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">Por favor ingresa una calificación entre 1 y 10.</div>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">Estado *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ old('status', $movie->status) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="col-12">
                        <label for="description" class="form-label">Descripción *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4" required>{{ old('description', $movie->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">Por favor ingresa una descripción.</div>
                        @enderror
                    </div>

                    <!-- Imagen -->
                    <div class="col-12">
                        <label for="image" class="form-label">Imagen de Portada</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                               id="image" name="image" accept="image/jpeg,image/png,image/webp">
                        <div class="form-text">Formatos aceptados: JPEG, PNG, WEBP (Máximo 2MB)</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if($movie->image_path)
                            <div class="mt-3">
                                <p class="mb-2">Imagen actual:</p>
                                <img src="{{ asset('storage/'.$movie->image_path) }}"
                                     class="img-thumbnail d-block mb-2"
                                     style="max-height: 200px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           id="remove_image" name="remove_image" value="1"
                                           {{ old('remove_image') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remove_image">
                                        Eliminar imagen actual
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Botones -->
                    <div class="col-12 d-flex justify-content-end gap-2 pt-4">
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-secondary px-4">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Validación del formulario del lado del cliente
(function () {
    'use strict'

    // Seleccionar todos los formularios con la clase needs-validation
    var forms = document.querySelectorAll('.needs-validation')

    // Aplicar validación a cada formulario
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()
</script>
@endsection
