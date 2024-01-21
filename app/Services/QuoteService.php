<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class QuoteService
{
    public function __construct() {}

    public function fetch(string $category): object|null
    {
        //ray('fetch being called for category: ' . $category);
        $endpoint = config('services.apininjas.endpoints.quotes');
        $api_key = config('services.apininjas.api_key');

        try {
            $response = Http::acceptJson()
                ->withHeaders(['X-Api-Key' => $api_key])
                ->get($endpoint, [
                    'category' => $category,
                ]);

            $this->quote = json_decode($response->body())[0];
        } catch (\Throwable $th) {
            $this->quote = null;
        }

        return $this->quote;
    }

}
