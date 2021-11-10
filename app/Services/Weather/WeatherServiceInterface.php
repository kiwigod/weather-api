<?php

namespace App\Services\Weather;

use App\Services\Weather\Pipeline\WeatherProcess;
use DateTimeInterface;
use Illuminate\Support\Collection;

interface WeatherServiceInterface
{
    /**
     * Retrieve weather data for the given city
     *
     * @param string $city
     * @return Collection
     */
    public function weatherByCity(string $city, DateTimeInterface $date): Collection;

    /**
     * Retrieve weather data for the specified city and apply the filters
     *
     * @param WeatherProcess $process
     * @return Collection
     */
    public function filteredWeatherByCity(WeatherProcess $process): Collection;
}
