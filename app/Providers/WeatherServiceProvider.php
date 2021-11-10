<?php

namespace App\Providers;

use App\Services\Weather\Pipeline\ApplyDateFilterHandler;
use App\Services\Weather\Pipeline\FetchWeatherInformationHandler;
use App\Services\Weather\Pipeline\NormalizeWeatherInformationHandler;
use App\Services\Weather\Pipeline\TemperatureUnitConversionHandler;
use App\Services\Weather\WeatherService;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    private array $steps = [
        FetchWeatherInformationHandler::class,
        NormalizeWeatherInformationHandler::class,
    ];

    private array $filters = [
        ApplyDateFilterHandler::class,
        TemperatureUnitConversionHandler::class,
    ];

    public function register()
    {
        $this->app->bind(WeatherService::class, function () {
            return new WeatherService(
                $this->steps,
                $this->filters
            );
        });
    }
}
