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
            "superadmin" => true,
            "password" => '$2y$12$bsncgdaWH2WNDcStnh5aF.SkUBSm3r.VurymzwDKc9MzU462pkjY2',
        ]);

        User::factory(10)->create();

        Category::factory(5)->create();
        $articles = Article::factory(10)->withImages()->create();

        foreach($articles as $article) {
            // Create array with 1 or 2 unique random numers between 1 and 5
            $keyword_ids = collect([rand(1, 5), rand(1, 5)])->unique()->toArray();

            $article->categories()->attach($keyword_ids);
        }



    }
}
