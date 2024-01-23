<?php

use App\Models\Post;

use function Spatie\PestPluginTestTime\testTime;

it('adds a slug when a post is created')
    ->expect(fn () => Post::factory()->create(['title' => 'My First Post']))
    ->slug->toEqual('my-first-post');

it('can determine if a blogpost is published', function () {
    $publishedPost = Post::factory()->published()->create();
    expect($publishedPost->is_published)->toBeTrue();

    $draftPost = Post::factory()->create(['published_at' => null]);
    expect($draftPost->is_published)->toBeFalse();
});

it('can determine if a blogpost is future scheduled through the scope', function () {
    // Arrange
    testTime()->freeze();
    $aPublisedPost = Post::factory()->create(['published_at' => now()]);
    $aDraftPost = Post::factory()->create(['published_at' => null]);

    // Act & Assert 1
    testTime()->subSecond(1);
    $publishedPosts = Post::isPublished()->get();
    expect($publishedPosts)->toHaveCount(0);

    // Act & Assert 2
    testTime()->addSecond(2);
    $publishedPosts = Post::isPublished()->get();
    expect($publishedPosts)->toHaveCount(1)->and($publishedPosts->first()->id)->toEqual($aPublisedPost->id);
});
