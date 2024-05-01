<?php

namespace App\Http\Controllers;

use App\Models\Article;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $articles = Article::with('author', 'categories', 'media')->latest('created_at')->take(6)->get();

        return view('public.welcome', ['articles' => $articles]);
    }
}
