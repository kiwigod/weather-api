<?php

namespace App\Services\Weather\Providers\Fetchers;

use DateTimeInterface;

interface WeatherFetchProviderInterface
{
    /**
     * Fetch the weather data for the given city at the provided date
     *
     * @param string $city
     * @param DateTimeInterface $date
     * @return string
     */
    public function fetchWeatherData(string $city, DateTimeInterface $date): string;

    /**
     * Which cities are supported by this provider
     *
     * @return array
     */
    public static function providesCities(): array;
}
