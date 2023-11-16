<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->with(['author', 'categories', 'media'])
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {
         /*
        if($post->published_at === null) {
            abort(403, 'This post is not published yet.');
        }*/

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:20'],
            'body' => ['required', 'min:5', 'max:2000'],
            'image' => ['file'],
        ]);

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'published_at' => null,
            'author_id' => 11,
        ]);

        if($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection();
        }

        session()->flash('success_notification', "Post '{$post->title}' created.");

        return redirect()->route('posts.show', $post);
    }

}
