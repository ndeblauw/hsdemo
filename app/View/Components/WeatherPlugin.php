<?php

namespace App\View\Components;

use App\Services\WeatherService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WeatherPlugin extends Component
{
    public int $temperature;
    public string $description;
    public string $city;
    private WeatherService $weather;

    public function __construct()
    {
        $this->weather = (new WeatherService())
            ->setLocationFromIp(request()->ip());
    }

    public function render(): View|Closure|string
    {
        $this->temperature = (int) $this->weather->getTemperature();
        $this->description = $this->weather->getDescription();
        $this->city = $this->weather->city;

        return view('components.weather-plugin');
    }
}
