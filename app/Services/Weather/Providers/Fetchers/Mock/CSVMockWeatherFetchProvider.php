<?php

namespace App\Services\Weather\Providers\Fetchers\Mock;

use App\Enums\CityEnum;
use App\Services\Weather\Providers\Fetchers\WeatherFetchProviderInterface;
use Carbon\Carbon;
use DateTimeInterface;

class CSVMockWeatherFetchProvider implements WeatherFetchProviderInterface
{
    public function fetchWeatherData(string $city, DateTimeInterface $date): string
    {
        $data = file_get_contents(storage_path('mock/temps.csv'));

        return preg_replace("#\"\d+\",#", sprintf("\"%s\",", Carbon::parse($date)->format('Ymd')), $data);
    }

    public static function providesCities(): array
    {
        return [ CityEnum::AMS ];
    }
}
