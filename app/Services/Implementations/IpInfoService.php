<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\IpService;
use Illuminate\Support\Facades\Http;

class IpInfoService implements IpService
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

        $response = Http::get("https://ipinfo.io/$this->ip_address?token=21d8dccf4dfec4");
        $response = json_decode($response->body());

        $this->city = $response->city;
        $this->coordinates = str($response->loc)->explode(',')->map(fn ($string) => (float) $string)->toArray();

        return $this;
    }
}
