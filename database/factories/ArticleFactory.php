<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $n = random_int(30,50);

        return [
            'title' => fake()->sentence,
            'content' => $this->generateTextInParagraphs($n),
            'user_id' => fake()->numberBetween(1, 10),
            'created_at' => fake()->dateTimeThisYear,

            'content_fr' => $this->generateTextInParagraphs($n),
            'content_nl' => $this->generateTextInParagraphs($n),
            'content_de' => $this->generateTextInParagraphs($n),
            'content_es' => $this->generateTextInParagraphs($n),
            'content_dk' => $this->generateTextInParagraphs($n),
            'content_se' => $this->generateTextInParagraphs($n),
            'content_th' => $this->generateTextInParagraphs($n),
            'content_ge' => $this->generateTextInParagraphs($n),
        ];
    }

    private function generateTextInParagraphs(int $numberOfParagrpahs): string
    {
        $text = '';

        for ($i = 0; $i < $numberOfParagrpahs; $i++) {
            $text .= fake()->realText(random_int(800, 1000))."\n\n";
        }

        return $text;
    }

    public function configure()
    {
        return $this->afterCreating(function (Article $article) {
            return $article;
        });
    }

    // Solution from https://laracasts.com/discuss/channels/testing/how-to-disable-factory-callbacks
    public function withImages(): self
    {
        //Alternative source: https://loremflickr.com/640/480';
        return $this->afterCreating(function (Article $article) {
            $url = 'https://source.unsplash.com/random/800x600/?cat';
            $article
                ->addMediaFromUrl($url)
                ->toMediaCollection();
        });
    }
}
