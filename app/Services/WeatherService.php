<?php

namespace App\Services;

use App\Services\Interfaces\IpService;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    private string $endpoint;

    private string $api_key;

    private int $cache_ttl;

    private float $lat;

    private float $lon;

    public string $city = 'none';

    public function __construct(protected IpService $ipservice)
    {
        $this->endpoint = config('services.openweathermap.endpoint');
        $this->api_key = config('services.openweathermap.api_key');

        $this->cache_ttl = config('app.env') === 'production' ? 3600 : 1;
    }

    public function setLocationFromIp(string $ip): self
    {
        $ip = $this->ipservice->for($ip)->get();

        $this->city = $ip->city;
        [$this->lat, $this->lon] = $ip->coordinates;

        return $this;
    }

    public function setLocationFromCity(string $city): self
    {
        $location = $this->getCityInformation($city);

        $this->city = $city;
        $this->lat = $location->lat;
        $this->lon = $location->lon;

        return $this;
    }

    public function getTemperature(): float
    {
        return $this->getWeather()->main->temp;
    }

    public function getDescription(): string
    {
        return $this->getWeather()->weather[0]->description;
    }

    private function getCityInformation(string $city): object
    {
        return cache()->remember(
            key: "weather-city-{$city}",
            ttl: $this->cache_ttl,
            callback: function () use ($city) {
                $response = Http::acceptJson()->get($this->endpoint.'/geo/1.0/direct', [
                    'q' => $city,
                    'limit' => 1,
                    'appid' => $this->api_key,
                ]);

                return json_decode($response->body())[0];
            });
    }

    private function getWeather(): object
    {
        return cache()->remember(
            key: "weather-{$this->lat}-{$this->lon}",
            ttl: $this->cache_ttl,
            callback: function () {
                $response = Http::acceptJson()->get($this->endpoint.'/data/2.5/weather', [
                    'lat' => $this->lat,
                    'lon' => $this->lon,
                    'units' => 'metric',
                    'appid' => $this->api_key,
                ]);

                return json_decode($response->body());
            });
    }
}
