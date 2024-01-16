<?php

namespace App\Livewire;

use App\Services\WeatherService;
use Livewire\Component;

class WeatherShowPlugin extends Component
{
    public bool $showChangeCityForm = false;

    public int $temperature;

    public string $description;

    public string $city;

    public function __construct()
    {
        $weather = app(WeatherService::class);

        $this->weather = session()->has('weather_show_plugin_city')
            ? $weather->setLocationFromCity(session()->get('weather_show_plugin_city'))
            : $weather->setLocationFromIp(request()->ip());
    }

    public function setCity()
    {
        $this->weather->setLocationFromCity($this->city);
        session()->put('weather_show_plugin_city', $this->city);

        $this->showChangeCityForm = false;
    }

    public function render()
    {
        $this->temperature = (int) $this->weather->getTemperature();
        $this->description = $this->weather->getDescription();
        $this->city = $this->weather->city;

        return view('livewire.weather-show-plugin');
    }
}
