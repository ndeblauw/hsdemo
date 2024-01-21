<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WelcomeController extends Controller
{
    public function welcome()
    {
        if (request()->has('referrer_id')) {
            session()->flash('referrer', User::find(request()->referrer_id)->name);
        }

        $recent_news = Cache::remember('welcome.recent_news', config('app.cache_ttl'), function () {
            return Post::isPublished()->with(['media', 'categories', 'author'])->take(4)->orderByDesc('published_at')->get();
        });

        //ray($recent_news->pluck('published_at', 'id')->map(fn($d) => $d?->toDateString())->toArray())->blue();

        $authors = Cache::remember('welcome.authors', config('app.cache_ttl'), function () {
            return User::select(['name'])->with('posts')->get();
        });

        return view('welcome', compact('recent_news', 'authors'));
    }

}
