<?php

use App\Models\Post;
use App\Services\QuoteService;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $quote = Mockery::mock(QuoteService::class);
    $quote->shouldReceive('fetch')->with(Mockery::any())->andReturn(null);
    $this->app->instance(QuoteService::class, $quote);

    $weather = Mockery::mock(WeatherService::class);
    $weather
        ->shouldReceive("getTemperature")
        ->andReturn(66.66);
    $weather
        ->shouldReceive("getDescription")
        ->andReturn("Devilish hot");

    $weather
        ->shouldReceive("setLocationFromCity")
        ->with(Mockery::any())
        ->andReturnSelf();
    $weather
        ->shouldReceive("setLocationFromIp")
        ->with(Mockery::any())
        ->andReturnSelf();

    $this->app->instance(WeatherService::class, $weather);
});

test('welcome page is being displayed', function () {
    // Act
    //$response = $this->get('/');
    $response = $this->withSession(['weather_show_plugin_city' => 'brussels'])->get('/');

    // Assert
    $response->assertStatus(200);
});

test('4 most recent articles are shown', function () {
    // Arrange
    $posts = Post::factory(5)->withoutAfterCreating()
        ->create(['is_featured' => false])
        ->map(fn ($p) => tap($p, fn($p)=> $p->update([
            'published_at' => now()->subDays(2*$p->id)
        ])))
        ->sortByDesc(fn ($p) => $p->published_at);

    ray($posts->pluck('published_at', 'title')->map(fn($d) => $d?->toDateString())->toArray());

    // Act
    $response = $this->get('/');

    // Assert - only first 4 published posts are shown in correct order, 5th is not shown
    $response->assertSeeInOrder($posts->take(4)->pluck('title')->toArray());
    $response->assertDontSee($posts->skip(4)->take(1)->first()->title);
});

test('4 most recent, none of them unpublished, articles are shown', function () {
    // Arrange
    $posts = Post::factory(5)->withoutAfterCreating()
        ->create(['is_featured' => false])
        ->map(fn ($p) => tap($p, fn($p)=> $p->update([
            'published_at' => $p->published_at ?? now()->subDays($p->id)
        ])))
        ->sortByDesc(fn ($p) => $p->published_at);

    ray($posts->pluck('published_at', 'id')->map(fn($d) => $d?->toDateString())->toArray());

    $posts->first()->update(['published_at' => null]);
    $posts->first()->refresh();
    ray($posts->pluck('published_at', 'id')->map(fn($d) => $d?->toDateString())->toArray());

    // Act
    $response = $this->withSession(['weather_show_plugin_city' => 'brussels'])->get('/');

    // Assert that (different!) 4 most recent articles are shown
    $response->assertDontSee($posts->first()->title);
    $response->assertSeeInOrder($posts->skip(1)->take(4)->pluck('title')->toArray());

});
