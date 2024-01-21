<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5, true),
            'body' => fake()->paragraphs(3, true),
            'is_flagged' => fake()->boolean(20),
            'is_featured' => fake()->boolean(35),
            'published_at' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
            'author_id' => User::factory(),
            //'categories' => Category::factory(fake()->numberbetween(1, 3)),
        ];
    }

    public function published(): Factory
    {
        return $this->state([
            'published_at' => fake()->dateTimeBetween('-1 year'),
        ]);
    }

    public function draft(): Factory
    {
        return $this->state([
            'published_at' => null,
        ]);
    }

    public function configure()
    {
         return $this->afterCreating(function (Post $post) {
             $url = 'https://loremflickr.com/320/240';
             $post
                ->addMediaFromUrl($url)
                ->toMediaCollection();
        });
    }

    // Solution from https://laracasts.com/discuss/channels/testing/how-to-disable-factory-callbacks
    public function withoutAfterCreating()
    {
        $this->afterCreating = new Collection;

        return $this;
    }
}
