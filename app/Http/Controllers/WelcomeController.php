<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class WelcomeController extends Controller
{
    public function welcome()
    {
        if(request()->has('referrer_id')) {
            session()->flash('referrer', User::find(request()->referrer_id)->name);
        }

        $recent_news = Cache::remember('welcome.recent_news', config('app.cache_ttl'), function() {
            return Post::with(['media', 'categories', 'author'])->orderBy('published_at', 'desc')->take(4)->get();
        });

        $authors = Cache::remember('welcome.authors', config('app.cache_ttl'), function() {
            return User::select(['name'])->with('posts')->get();
        });

        return view('welcome', compact('recent_news', 'authors'));
    }
}
