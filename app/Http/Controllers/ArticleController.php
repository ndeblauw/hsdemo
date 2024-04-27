<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author', 'media')
            ->orderByDesc('created_at')->paginate(4);

        return view('articles.index', ['articles' => $articles]);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        $related = $this->getRelatedArticles($article);

        return view('articles.show', ['article' => $article, 'related' => $related]);
    }

    private function getRelatedArticles(Article $article, $numberOfArticles = 6)
    {
        $keywords = $article->categories->pluck('id');

        $related = Article::query()
            ->with('author', 'media', 'categories')
            ->where('id', '!=', $article->id)
            ->whereHas('categories', function($query) use ($keywords) {
                $query->whereIn('categories.id', $keywords);
                })
            ->limit($numberOfArticles)
            ->orderByDesc('created_at')
            ->get();

        return $related;
    }

}
