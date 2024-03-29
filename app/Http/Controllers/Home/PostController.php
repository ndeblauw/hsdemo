<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->with(['author', 'categories', 'media'])
            ->where('author_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {
        $this->checkIfUserHasAccess($post);

        /*
       if($post->published_at === null) {
           abort(403, 'This post is not published yet.');
       }*/

        return view('home.posts.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        $categories = \App\Models\Category::orderBy('name')->pluck('name', 'id');

        return view('home.posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'published_at' => null,
            'author_id' => auth()->id(),
        ]);

        $post->categories()->attach($request->categories);

        /* alternative use case: have free text input instead of structured:
        $category_list = str($request->categories)->replace(' ', '')->explode(',');
        foreach($category_list as $category_name) {
            $category = \App\Models\Category::firstOrCreate(
                ['name' => $category_name]
            );
            $post->categories()->attach($category);
        }
        */

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection();
        }

        session()->flash('success_notification', "Post '{$post->title}' created.");

        return redirect()->route('home.posts.show', $post);
    }

    public function edit(Post $post)
    {
        $this->checkIfUserHasAccess($post);

        // edit actions
    }

    public function update(Request $request, Post $post)
    {
        $this->checkIfUserHasAccess($post);

        // update actions
    }

    public function destroy(Post $post)
    {
        $this->checkIfUserHasAccess($post);

        // delete actions
    }

    private function checkIfUserHasAccess(Post $post)
    {
        if (auth()->id() !== $post->author_id) {
            session()->flash('error_notification', "You are not authorized to see or to make changes to Post with id '{$post->id}'");

            return redirect()->back();
        }
    }
}
