<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['home', 'logout']),
            new Middleware('auth', only: ['home', 'logout'])
        ];
    }

    public function index() {
        $genres = Genre::all();
        return view('genre.index', compact('genres'));
    }

    public function create() {
        return View('genre.create');
    }
    public function edit(Genre $genre) {
        return View('genre.edit', compact('genre'));
    }
    public function store(Request $request):RedirectResponse {
        $validatedData = $request->validate([
            'genre' => 'required',
        ]);

        Genre::create($validatedData);
        return redirect()->route('genre.index');
    }
    
    public function update(Request $request, Genre $genre):RedirectResponse {
        $validatedData = $request->validate([
            'genre' => 'required',
        ]);

        $genre->update($validatedData);
        return redirect()->route('genre.index');
    }

    public function destroy(Genre $genre): RedirectResponse {
        $genre->delete();
        return redirect()->route('genre.index');
    }
}
