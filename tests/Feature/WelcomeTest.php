<?php

use App\Models\Post;
use App\Services\Implementations\GetQuoteService;

beforeEach(function () {
    $fakeQuote = Mockery::mock(GetQuoteService::class);
    $fakeQuote->shouldReceive('get')->andReturn(null);
    $this->app->instance(GetQuoteService::class, $fakeQuote);

    $fakeWeather = Mockery::mock(\App\Services\WeatherService::class);
    $fakeWeather->shouldReceive('getTemperature')->andReturn(66.6);
    $fakeWeather->shouldReceive('getDescription')->andReturn('Develishly hot');
    $fakeWeather->shouldReceive('setLocationFromIp')->andReturnSelf();
    $this->app->instance(\App\Services\WeatherService::class, $fakeWeather);

});

test('welcome page is being displayed', function () {
    // Act
    $response = $this->get('/');

    // Assert
    $response->assertStatus(200);
});

test('4 most recent articles are shown', function () {
    // Arrange
    $posts = Post::factory(5)->published()
        ->create(['is_featured' => false])
        ->sortByDesc(fn ($p) => $p->published_at);

    // Act
    $response = $this->get('/');

    // Assert - only first 4 published posts are shown in correct order, 5th is not shown
    $response->assertSeeInOrder($posts->take(4)->pluck('title')->toArray());
    $response->assertDontSee($posts->skip(4)->take(1)->first()->title);
});

test('4 most recent articles are shown (and no unpublished ones)', function () {
    // Arrange
    $posts = Post::factory(5)->published()
        ->create(['is_featured' => false])
        ->sortByDesc(fn ($p) => $p->published_at);

    $posts = $posts->map(function ($p) use ($posts) {
        if ($p == $posts->first()) {
            $p->update(['published_at' => null]);
        }

        return $p;
    });

    // Act
    $response = $this->get('/');

    // Assert that (different!) 4 most recent articles are shown
    $response->assertSeeInOrder($posts->skip(1)->take(4)->pluck('title')->toArray());
    $response->assertDontSee($posts->first()->title);
});
