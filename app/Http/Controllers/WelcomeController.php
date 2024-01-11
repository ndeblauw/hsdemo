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
        if(request()->has('referrer_id')) {
            session()->flash('referrer', User::find(request()->referrer_id)->name);
        }

        $recent_news = Cache::remember('welcome.recent_news', config('app.cache_ttl'), function() {
            return Post::isPublished()->with(['media', 'categories', 'author'])->orderBy('published_at', 'desc')->take(4)->get();
        });

        $authors = Cache::remember('welcome.authors', config('app.cache_ttl'), function() {
            return User::select(['name'])->with('posts')->get();
        });

        $quote = $this->getQuote('money');

        return view('welcome', compact('recent_news', 'authors', 'quote'));
    }

    private function getQuote(string $category): ?object
    {
        $endpoint = "https://api.api-ninjas.com/v1/quotes";
        $api_key = "AbPwNFtbXZMG/BrbJ35Oug==LnmwnCbMeFK2Ssal";

        try {
            $response = Http::acceptJson()
                ->withHeaders(["X-Api-Key" => $api_key])
                ->get($endpoint, [
                    'category' => $category,
                ]);

                $quote = json_decode($response->body())[0];
        } catch (\Throwable $th) {
            $quote = null;
        }


        return $quote;
    }
}
