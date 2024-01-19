<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class FeaturedNews extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        $featured_news = Cache::remember('featured_news', config('app.cache_ttl'), function () {
            return Post::select(['id', 'title', 'slug'])->where('is_featured', true)->with('media')->orderBy('published_at', 'desc')->take(4)->get();
        });

        return view('components.featured-news', compact('featured_news'));
    }
}
