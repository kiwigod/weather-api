<?php

namespace App\Services\Weather\Providers\Fetchers\Mock;

use App\Enums\CityEnum;
use App\Services\Weather\Providers\Fetchers\WeatherFetchProviderInterface;

class CSVMockWeatherFetchProvider implements WeatherFetchProviderInterface
{
    public function fetchWeatherData(string $city): string
    {
        return file_get_contents(storage_path('mock/temps.csv'));
    }

    public static function providesCities(): array
    {
        return [ CityEnum::AMS ];
    }
}
