<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

/**
 * PlayController - Handle game playback.
 * 
 * Routes:
 * - GET /play/{game} - Play game (browser iframe atau download)
 * 
 * Security:
 * - Hanya user yang sudah membeli game bisa akses
 * - Middleware auth sudah di routes/web.php
 */
class PlayController extends Controller
{
    /**
     * Play game - Check ownership, serve iframe atau download button.
     * 
     * Type: 
     * - 'browser': Tampilkan iframe dengan embed_url
     * - 'download': Tampilkan download button dengan file_path
     */
    public function play(Game $game)
    {
        // Check ownership - user harus sudah membeli game ini
        $isOwned = auth()->user()->games()
            ->where('game_id', $game->id)
            ->exists();

        if (!$isOwned) {
            abort(403, 'Anda belum membeli game ini!');
        }

        return view('play', compact('game'));
    }
}
