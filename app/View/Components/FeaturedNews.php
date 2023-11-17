<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedNews extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        $featured_news = Post::where('is_featured', true)->with('media')->orderBy('published_at', 'desc')->take(4)->get();

        return view('components.featured-news', compact('featured_news'));
    }
}
