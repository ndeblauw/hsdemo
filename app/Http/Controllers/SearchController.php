<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function create()
    {
        return view('public.search.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:3|max:255',
        ]);

        $search_term = $request->search;

        // Look for keywords with the search term
        $category = Category::query()
            ->where('name', 'LIKE', '%'.$search_term.'%')
            ->first();

        $articles_from_keyword = $category?->articles;

        // Look for articles with the search term
        $articles_direct = Article::query()
            ->where('title', 'LIKE', '%'.$search_term.'%')
            ->orWhere('content', 'LIKE', '%'.$search_term.'%')
            ->get();

        $articles = $articles_direct->union($articles_from_keyword);

        return view('public.search.results', compact('articles', 'search_term'));

    }
}
