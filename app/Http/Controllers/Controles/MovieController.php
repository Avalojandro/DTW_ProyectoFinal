<?php

namespace App\Http\Controllers\Controles;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $genre = $request->input('genre');
        $status = $request->input('status');

        $query = Movie::query();

        if ($search) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        if ($genre && $genre != 'Todos') {
            $query->where('genre', $genre);
        }

        if ($status && $status != 'Todos') {
            $query->where('status', $status);
        }

        $movies = $query->latest()->paginate(12);

        return view('backend.movies.index', [
            'movies' => $movies,
            'genres' => Movie::genres(),
            'filters' => [
                'search' => $search,
                'genre' => $genre,
                'status' => $status
            ]
        ]);
    }

    public function create()
    {
        return view('backend.movies.create', [
            'genres' => Movie::genres(),
            'statusOptions' => $this->getStatusOptions()
        ]);
    }

    public function store(Request $request)
    {
        if (Auth::guest()) {
            return redirect("login");
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:'.(date('Y') + 5),
            'rating' => 'required|numeric|min:1|max:10',
            'description' => 'required|string',
            'status' => 'required|in:watched,pending',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('movie_images', 'public');
            $data['image_path'] = $path;
        }

        $movie = Movie::create($data);

        // Efecto especial si se marca como vista al crear
        if ($movie->status == 'watched') {
            return redirect()->route('movies.show', $movie->id)
                ->with('success', 'Película creada exitosamente!')
                ->with('show_applause', true);
        }

        return redirect()->route('movies.index')
            ->with('success', 'Película creada exitosamente!');
    }

    public function show($id)
    {
        try {
            $movie = Movie::findOrFail($id);

            return view('backend.movies.show', [
                'movie' => $movie,
                'genres' => Movie::genres(),
                'statusOptions' => $this->getStatusOptions()
            ]);
        } catch (\Exception $e) {
            return redirect()->route('movies.index')
                ->with('error', 'No se pudo encontrar la película solicitada');
        }
    }

    public function edit($id)
    {
        try {
            $movie = Movie::findOrFail($id);

            return view('backend.movies.edit', [
                'movie' => $movie,
                'genres' => Movie::genres(),
                'statusOptions' => $this->getStatusOptions(),
                'years' => range(date('Y') + 5, 1900)
            ]);
        } catch (\Exception $e) {
            return redirect()->route('movies.index')
                ->with('error', 'No se pudo cargar la película para edición');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $movie = Movie::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'genre' => 'required|string|max:255',
                'year' => 'required|integer|min:1900|max:'.(date('Y') + 5),
                'rating' => 'required|numeric|min:1|max:10',
                'description' => 'required|string',
                'status' => 'required|in:watched,pending',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'remove_image' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $validator->validated();

            if ($request->has('remove_image')) {
                if ($movie->image_path) {
                    Storage::disk('public')->delete($movie->image_path);
                }
                $data['image_path'] = null;
            }

            if ($request->hasFile('image')) {
                if ($movie->image_path) {
                    Storage::disk('public')->delete($movie->image_path);
                }

                $path = $request->file('image')->store('movie_images', 'public');
                $data['image_path'] = $path;
            }

            $movie->update($data);

            // Efecto especial si se marca como vista
            if ($movie->status == 'watched') {
                return redirect()->route('movies.show', $movie->id)
                    ->with('success', 'Película actualizada correctamente!')
                    ->with('show_applause', true);
            }

            return redirect()->route('movies.show', $movie->id)
                ->with('success', 'Película actualizada correctamente!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar la película: '.$e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $movie = Movie::findOrFail($id);

            if ($movie->image_path) {
                Storage::disk('public')->delete($movie->image_path);
            }

            $movie->delete();

            return redirect()->route('movies.index')
                ->with('success', 'Película eliminada exitosamente!');
        } catch (\Exception $e) {
            return redirect()->route('movies.index')
                ->with('error', 'Error al eliminar la película: '.$e->getMessage());
        }
    }

    protected function getStatusOptions()
    {
        return [
            'pending' => 'Pendiente',
            'watched' => 'Vista'
        ];
    }
}
