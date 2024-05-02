<?php

namespace App\Http\Controllers;

use App\Models\Article;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $articles = Article::query()
            //->select('id', 'user_id', 'title', 'content') // Only those data fields you need
            //->select('title', 'content') // Make sure to select enough!!!
            ->with('author', 'categories', 'media')
            ->latest('created_at')
            //->take(6) // Only the records you will need
            ->get();

        return view('public.welcome', ['articles' => $articles]);
    }
}
