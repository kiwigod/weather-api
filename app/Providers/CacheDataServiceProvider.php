<?php

namespace App\Providers;

use App\Services\Weather\CacheWeatherService;
use App\Services\Weather\WeatherService;
use App\Services\Weather\WeatherServiceInterface;
use Illuminate\Support\ServiceProvider;

class CacheDataServiceProvider extends ServiceProvider
{
    private const INTERFACE_CACHE_BINDINGS = [
        WeatherServiceInterface::class => CacheWeatherService::class
    ];

    private const CACHE_RESOLVER_BINDINGS = [
        CacheWeatherService::class => [WeatherServiceInterface::class, WeatherService::class]
    ];

    public function register()
    {
        foreach (self::CACHE_RESOLVER_BINDINGS as $abstract => $concrete)
        {
            $this->app->when($abstract)->needs($concrete[0])->give($concrete[1]);
        }

        foreach (self::INTERFACE_CACHE_BINDINGS as $abstract => $concrete)
        {
            $this->app->bind($abstract, $concrete);
        }
    }
}
