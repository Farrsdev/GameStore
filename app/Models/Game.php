<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'developer',
        'platform',
        'genre',
        'stock',
        'price',
        'release_date',
        'rating',
        'cover',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'float',
        'release_date' => 'date',
        'stock' => 'integer',
    ];

    /**
     * Get the genres for this game.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genre')
            ->select('genres.id', 'genres.name', 'genres.slug', 'genres.description');
    }
}
