<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "name" => "Nico Deblauwe",
            "email" => "nico@deblauwe.be",
            "password" => '$2y$12$bsncgdaWH2WNDcStnh5aF.SkUBSm3r.VurymzwDKc9MzU462pkjY2',
        ]);

        User::factory(10)->create();

        Category::factory(5)->create();
        Article::factory(10)->create();

    }
}
