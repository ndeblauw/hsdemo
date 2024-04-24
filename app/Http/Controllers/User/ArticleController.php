<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('user_id', auth()->user()->id)->get();

        return view('user.articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        return view('user.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:20'],
            'content' => 'required',
        ]);

        $title = $request->title;
        $content = $request->content;

        $article = Article::create([
            'title' => $title,
            'content' => $content,
            'user_id' => auth()->user()->id,
        ]);

        session()->flash('success_message', 'Your article was stored successfully');


        return redirect()->route('articles.show', ['article' => $article->id]);
    }

    public function show(string $id)
    {
        return view('user.articles.show', ['article' => Article::find($id) ]);
    }

    public function edit(string $id)
    {
        $article = Article::find($id);

        return view('user.articles.edit', ['article' => $article]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:20'],
            'content' => 'required',
            'user_id' => ['required', 'numeric', 'exists:users,id'],
        ]);

        $article = Article::find($id);

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
        ]);

        $article->categories()->sync($request->categories);

        session()->flash('success_message', 'Your article was updated successfully');

        return redirect()->route('articles.show', ['article' => $article->id]);
    }


    public function destroy(string $id)
    {
        $article = Article::find($id);

        $article->delete();

        return redirect()->route('articles.index');
    }
}
