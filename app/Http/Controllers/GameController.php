<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::latest()->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = \App\Models\Genre::all();
        return view('admin.games.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Handle genres yang mungkin dikirim sebagai string (dari cache browser)
        if (is_string($request->genres)) {
            $request->merge([
                'genres' => array_filter(array_map('trim', explode(',', $request->genres)))
            ]);
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'developer' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'release_date' => 'nullable|date',
            'rating' => 'nullable|numeric|min:0|max:10',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('cover', 'genres');
        $genres = array_map('intval', (array)$request->genres);

        if ($request->hasFile('cover')) {
            // Create covers folder if not exists
            if (!file_exists(public_path('covers'))) {
                mkdir(public_path('covers'), 0755, true);
            }

            $cover = $request->file('cover');
            $coverName = time() . '_' . $cover->getClientOriginalName();
            $cover->move(public_path('covers'), $coverName);
            $data['cover'] = $coverName;
        }

        $game = Game::create($data);
        $game->genres()->sync($genres);

        return redirect()->route('admin.games.index')
            ->with('success', 'Game created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $game = Game::findOrFail($id);
        return view('admin.games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $game = Game::findOrFail($id);
        $genres = \App\Models\Genre::all();
        $selectedGenres = $game->genres()->pluck('id')->toArray();
        return view('admin.games.edit', compact('game', 'genres', 'selectedGenres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $game = Game::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'developer' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'release_date' => 'nullable|date',
            'rating' => 'nullable|numeric|min:0|max:10',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('cover', 'genres');
        $genres = $request->genres;

        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($game->cover) {
                $oldCoverPath = public_path('covers/' . $game->cover);
                if (file_exists($oldCoverPath)) {
                    unlink($oldCoverPath);
                }
            }
            
            $cover = $request->file('cover');
            $coverName = time() . '_' . $cover->getClientOriginalName();
            $cover->move(public_path('covers'), $coverName);
            $data['cover'] = $coverName;
        }

        $game->update($data);
        $game->genres()->sync($genres);

        return redirect()->route('admin.games.index')
            ->with('success', 'Game updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game = Game::findOrFail($id);
        
        // Delete cover if exists
        if ($game->cover) {
            $coverPath = public_path('covers/' . $game->cover);
            if (file_exists($coverPath)) {
                unlink($coverPath);
            }
        }
        
        $game->delete();

        return redirect()->route('admin.games.index')
            ->with('success', 'Game deleted successfully!');
    }

    /**
     * Show admin dashboard.
     */
    public function adminDashboard()
    {
        $totalGames = Game::count();
        $totalStock = Game::sum('stock');
        $totalUsers = \App\Models\User::where('isAdmin', false)->count();
        $recentGames = Game::latest()->limit(3)->get();
        
        return view('admin.dashboard', compact('totalGames', 'totalStock', 'totalUsers', 'recentGames'));
    }

    /**
     * Display games for user dashboard.
     */
    public function userIndex()
    {
        $games = Game::latest()->get();
        return view('user.dashboard', compact('games'));
    }

    /**
     * Show game detail for user.
     */
    public function userShow(string $id)
    {
        $game = Game::findOrFail($id);
        return view('user.show', compact('game'));
    }
}
