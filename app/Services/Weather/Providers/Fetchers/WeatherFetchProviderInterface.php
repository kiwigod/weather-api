<?php

namespace App\Services\Weather\Providers\Fetchers;

interface WeatherFetchProviderInterface
{
    /**
     * Fetch the weather data for the given city
     *
     * @param string $city
     * @return string
     */
    public function fetchWeatherData(string $city): string;

    /**
     * Which cities are supported by this provider
     *
     * @return array
     */
    public static function providesCities(): array;
}
