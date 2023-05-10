<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        foreach(Movie::all() as $movie) {
            $genre = Genre::inRandomOrder()->take(3)->get();
            $movie->genres()->attach($genre);
        }
    }
}
