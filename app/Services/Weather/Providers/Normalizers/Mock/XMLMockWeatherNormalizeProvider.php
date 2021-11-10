<?php

namespace App\Services\Weather\Providers\Normalizers\Mock;

use App\Models\Internal\WeatherPrediction;
use App\Services\Weather\Providers\Normalizers\WeatherNormalizeProviderInterface;
use App\Services\Weather\Unit\TemperatureUnitGuesser;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class XMLMockWeatherNormalizeProvider implements WeatherNormalizeProviderInterface
{
    public function normalize(string $data): Collection
    {
        $xml = simplexml_load_string($data);

        $scale = TemperatureUnitGuesser::guess((string) $xml->attributes()->scale);
        $city = (string) $xml->city;
        $date = Carbon::createFromFormat('Ymd', (string) $xml->date);

        $collection = new Collection();

        foreach ($xml->prediction as $prediction)
        {
            $collection->push(new WeatherPrediction(
                $date->clone()->setTimeFromTimeString((string) $prediction->time),
                $scale,
                intval($prediction->value),
                $city
            ));
        }

        return $collection;
    }
}
