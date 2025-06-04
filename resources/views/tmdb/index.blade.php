@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Catálogo Mundial (TMDB)</h1>
        <div id="tmdb-list" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <!-- Las películas se insertarán aquí -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const API_KEY = '38682d354472785e7b94cd008c3ba2cb';

        axios.get('https://api.themoviedb.org/3/movie/popular', {
            params: {
                api_key: API_KEY,
                language: 'es-ES',
                page: 1
            }
        })
        .then(res => {
            const list = document.getElementById('tmdb-list');
            res.data.results.forEach(movie => {
                const col = document.createElement('div');
                col.className = 'col';

                const encodedTitle = encodeURIComponent(movie.title);

                col.innerHTML = `
                    <div class="card h-100 shadow-sm">
                        <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" class="card-img-top" alt="${movie.title}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">${movie.title}</h5>
                            <p class="card-text text-muted mb-2">${movie.release_date}</p>
                            <p class="card-text">${movie.overview.slice(0, 100)}...</p>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-outline-primary btn-sm" onclick="window.location.href='/peliculas?search=${encodedTitle}'">
                                Ver más
                            </button>
                        </div>
                    </div>
                `;

                list.appendChild(col);
            });
        })
        .catch(err => {
            console.error('Error:', err);
            const list = document.getElementById('tmdb-list');
            list.innerHTML = `<div class="alert alert-danger">No se pudo cargar el catálogo.</div>`;
        });
    </script>
@endpush