<?php

namespace App\Services\Weather;

use App\Services\Weather\Pipeline\WeatherProcess;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CacheWeatherService implements WeatherServiceInterface
{
    private const CACHE_KEY_PREFIX = 'weather_';

    public function __construct(
        private WeatherServiceInterface $resolver
    ) {}

    public function weatherByCity(string $city, DateTimeInterface $date): Collection
    {
        // users should be able to bypass the caching logic
        if (! ($weather = Cache::get($key = self::CACHE_KEY_PREFIX . $city . Carbon::parse($date)->unix())) || ! empty(app('request')->user()))
        {
            return tap($this->resolver->weatherByCity($city, $date), function ($weather) use ($key) {
                Cache::put($key, $weather, config('weather.cache_ttl'));
            });
        }

        return $weather;
    }

    public function filteredWeatherByCity(WeatherProcess $process): Collection
    {
        $process->weatherInformation = $this->weatherByCity($process->city, $process->date);

        return $this->resolver->filteredWeatherByCity($process);
    }
}
