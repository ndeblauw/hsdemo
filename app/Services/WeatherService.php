<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    private $endpoint = "https://api.openweathermap.org/data/2.5";
    private $api_key = "4133a59570cf388de4679424280beee6";
    private $cache_ttl;

    private float $lat;
    private float $lon;
    public string $city;

    public function __construct()
    {
        $this->cache_ttl = config('app.env') === 'production' ? 3600 : 1;
    }

    public function setLocationFromIp(string $ip): self
    {
        $ip = (new IpLocationService())->for($ip)->get();

        $this->city = $ip->city;
        [$this->lat, $this->lon] = $ip->coordinates;

        return $this;
    }

    public function setLocation(string $city): self
    {
        $location = $this->getCityInformation($city);

        $this->lat = $location->lat;
        $this->lon = $location->lon;

        return $this;
    }

    public function getTemperature()
    {
        $data = $this->getWeather();
        return $data->main->temp;
    }

    public function getDescription()
    {
        $data = $this->getWeather();
        return $data->weather[0]->description;
    }



    private function getCityInformation(string $city): object
    {
        $response = Http::acceptJson()->get("http://api.openweathermap.org/geo/1.0".'/direct', [
            "q" => $city,
            "limit" => 1,
            "appid" => $this->api_key
        ]);

        return json_decode($response->body())[0];
    }

    private function getWeather()
    {
        return cache()->remember(
            key: "weather-{$this->lat}-{$this->lon}",
            ttl: $this->cache_ttl,
            callback: function () {
                ray('hitting the endpoint');
                $response = Http::acceptJson()->get($this->endpoint.'/weather', [
                    "lat" => $this->lat,
                    "lon" => $this->lon,
                    "units" => "metric",
                    "appid" => $this->api_key
                ]);
                return json_decode($response->body());
            });
    }



}
