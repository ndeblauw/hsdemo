<?php

namespace App\View\Components;

use App\Services\Weather;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WeatherPlugin extends Component
{
    public $temperature;
    public $description;
    public $city;

    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        $weather = new Weather();
        $weather = $weather->setLocationFromIp(request()->ip());
        $this->temperature = $weather->getTemperature();
        $this->description = $weather->getDescription();
        $this->city = $weather->city;

        return view('components.weather-plugin');
    }
}
