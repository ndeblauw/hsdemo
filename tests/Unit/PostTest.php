<?php

use App\Models\Post;
use function Spatie\PestPluginTestTime\testTime;

it('adds a slug when a blog post is created')
    ->expect(fn () => Post::factory()->withoutAfterCreating()->create(['title' => 'My blogpost']))
    ->slug->toEqual('my-blogpost');

it('can determine if a blogpost is published', function() {
    $publishedPost = Post::factory()->withoutAfterCreating()->published()->create();
    expect($publishedPost->is_published)->toBeTrue();

    $draftPost = Post::factory()->draft()->withoutAfterCreating()->create();
    expect($draftPost->is_published)->toBeFalse();
});

it('has a scope to retrieve all published blogposts', function() {
    // Arrange
    testTime()->freeze();
    $aPublishedPost = Post::factory()->withoutAfterCreating()->create(['published_at' => now()]);
    $aDraftPost = Post::factory()->draft()->withoutAfterCreating()->create();

    // Act & Assert 1: the past
    testTime()->subSecond();
    $publishedPosts = Post::isPublished()->get();
    expect($publishedPosts)->toHaveCount(0);

    // Act & Assert 2: the future
    testTime()->addSecond();
    $publishedPosts = Post::isPublished()->get();
    expect($publishedPosts)->toHaveCount(1)
        ->and($publishedPosts[0]->id)->toEqual($aPublishedPost->id);
});

