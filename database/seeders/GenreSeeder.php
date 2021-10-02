<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = collect([
            'Speed Metal',
            'Transh Metal',
            'Power Metal',
            'Black Metal',
            'Pagan Metal',
            'Viking Metal',
            'Folk Metal',
            'Gothic Metal',
            'Glam Metal',
            'Hair Metal',
            'Doom Metal',
            'Heavy Metal',
            'Alternative Metal',
            'Modern Metal',
            'Post Metal',
        ]);

        $genres->each(function ($genre) {
            Genre::create([
                'name' => $genre,
                'slug' => Str::slug('genre')
            ]);
        });
    }
}
