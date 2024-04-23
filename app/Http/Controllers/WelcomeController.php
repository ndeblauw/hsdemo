<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $articles = Article::latest('created_at')->take(6)->get();

        return view('welcome', ['articles' => $articles]);
    }
}
