<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory(5)->create();
        $users = User::factory(10)->create();

        $posts = Post::factory(20)
            ->recycle($users)
            //->has(Category::factory()->count(2))
            //->recycle($categories)
            //->hasAttached($categories)
            ->create()
            //->each(fn($p) => $p->categories()->attach($categories->random(2)));
            ->each(fn($p) => $p->categories()->attach($categories->random(rand(1, 3))));

        User::create([
            'name' => 'Nico',
            'email' => 'nico@deblauwe.be',
            'password' => '$2y$12$NcMAoaOmrpeQ124puIArRuEz8C35sBWw3e5YlsYZYO7ixpNaa7Qzi',
            'is_admin' => true,
        ]);

    }
}
