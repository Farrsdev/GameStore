<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_genre')
            ->select('games.id', 'games.title', 'games.developer', 'games.platform', 'games.price', 'games.cover', 'games.stock', 'games.rating', 'games.release_date', 'games.created_at', 'games.updated_at');
    }
}

