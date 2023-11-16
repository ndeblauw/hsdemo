<?php

namespace App\Http\Controllers;

use App\Models\Post;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $recent_news = Post::orderBy('published_at', 'desc')->take(3)->get();

        return view('welcome', compact('recent_news'));
    }
}
