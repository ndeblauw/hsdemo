<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\IpService;
use Illuminate\Support\Facades\Http;

class GetQuoteService
{
    public function __construct()
    {
        //$this->cache_ttl = config('app.env') === 'production' ? 3600 : 1;
    }

    public function get(string $category): ?object
    {
        $endpoint = config('services.apininjas.endpoints.quotes');
        $api_key = config('services.apininjas.api_key');

        try {
            $response = Http::acceptJson()
                ->withHeaders(['X-Api-Key' => $api_key])
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
