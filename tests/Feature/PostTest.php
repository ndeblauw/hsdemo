<?php

use App\Models\Post;
use App\Models\User;

test('posts index page is being displayed', function () {
    // Act
    $response = $this->get('/posts/');

    // Assert
    $response->assertStatus(200);
});

test('posts show page is being displayed', function () {
    // Arrange
    $author = User::factory()->create();
    $post = Post::factory()->create(['author_id' => 1]);

    // Act
    $response = $this->get('/posts/'.$post->slug);

    // Assert
    $response->assertStatus(200);
});

test('posts show page contains title, body and author info', function () {
    // Arrange
    $author = User::factory()->create();
    $post = Post::factory()->create(['author_id' => 1]);

    // Act
    $response = $this->get('/posts/'.$post->slug);

    // Assert
    $response->assertSeeInOrder([$post->title, $post->author->name, $post->body]);
});
