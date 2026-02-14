<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    /**
     * Show the form for creating a new genre.
     */
    public function create()
    {
        return view('admin.genre-create');
    }

    /**
     * Store a newly created genre in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
            'description' => 'nullable|string',
        ]);

        Genre::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.genres.index')
            ->with('success', 'Genre created successfully!');
    }

    /**
     * Show the form for editing a genre.
     */
    public function edit(Genre $genre)
    {
        return view('admin.genre-edit', compact('genre'));
    }

    /**
     * Update a genre in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
            'description' => 'nullable|string',
        ]);

        $genre->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.genres.index')
            ->with('success', 'Genre updated successfully!');
    }

    /**
     * Display a listing of genres.
     */
    public function index()
    {
        $genres = Genre::latest()->paginate(10);
        return view('admin.genre-index', compact('genres'));
    }

    /**
     * Remove a genre from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('admin.genres.index')
            ->with('success', 'Genre deleted successfully!');
    }
}
