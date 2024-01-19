<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\IpService;
use Illuminate\Support\Facades\Http;

class IpLocationService implements IpService
{
    private int $cache_ttl;

    private string $ip_address;

    public array $coordinates = [null, null];

    public ?string $city = null;

    public function __construct()
    {
        $this->cache_ttl = config('app.env') === 'production' ? 3600 : 1;
    }

    public function for(string $ip): self
    {
        $this->ip_address = $ip;

        return $this;
    }

    public function get(): self
    {
        if (config('app.env') === 'local') {
            $this->ip_address = '95.130.40.188'; // Hack for local development, set location to Bxl
        }

        $response = Http::get(
            url: config('services.ipstack.endpoint')."/$this->ip_address",
            query: ['access_key' => config('services.ipstack.api_key')]
        );
        $response = json_decode($response->body());

        $this->city = $response->city;
        $this->coordinates = [$response->latitude, $response->longitude];

        return $this;
    }
}
