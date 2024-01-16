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
    private WeatherService $weather;

    public function __construct()
    {
        $this->weather = (new WeatherService());

        if( session()->has('weather_show_plugin_city') ) {

            $this->weather = $this->weather
                ->setLocationFromCity(session()->get('weather_show_plugin_city'));
        } else {
            $this->weather = $this->weather
                ->setLocationFromIp(request()->ip());
        }

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
