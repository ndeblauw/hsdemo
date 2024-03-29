<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->with(['author', 'categories', 'media'])
            ->isPublished()
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('site.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {
        /*
        if($post->published_at === null) {
           abort(403, 'This post is not published yet.');
        }*/

        return view('site.posts.show', [
            'post' => $post,
        ]);
    }
}
