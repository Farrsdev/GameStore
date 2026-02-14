<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            [
                'name' => 'Action',
                'description' => 'Fast-paced games with combat and adventure elements'
            ],
            [
                'name' => 'RPG',
                'description' => 'Role-playing games with character progression and storytelling'
            ],
            [
                'name' => 'Strategy',
                'description' => 'Games requiring tactical thinking and planning'
            ],
            [
                'name' => 'Sports',
                'description' => 'Games simulating real-world sports activities'
            ],
            [
                'name' => 'Adventure',
                'description' => 'Exploratory games focused on story and discovery'
            ],
            [
                'name' => 'Puzzle',
                'description' => 'Games focused on solving puzzles and logic challenges'
            ],
            [
                'name' => 'FPS',
                'description' => 'First-person shooter games'
            ],
            [
                'name' => 'Horror',
                'description' => 'Games designed to frighten and create suspense'
            ],
            [
                'name' => 'Racing',
                'description' => 'Racing and driving simulation games'
            ],
            [
                'name' => 'Simulation',
                'description' => 'Games that simulate real-world scenarios'
            ],
            [
                'name' => 'Metroidvania',
                'description' => 'A subgenre of action-adventure games that focuses on the exploration of large, interconnected, non-linear maps and skill-based progression.'
            ],
        ];

        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre['name'],
                'slug' => Str::slug($genre['name']),
                'description' => $genre['description'],
            ]);
        }
    }
}
