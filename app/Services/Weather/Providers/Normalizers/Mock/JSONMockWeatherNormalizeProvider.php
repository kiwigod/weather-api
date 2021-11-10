<?php

namespace App\Services\Weather\Providers\Normalizers\Mock;

use App\Models\Internal\WeatherPrediction;
use App\Services\Weather\Providers\Normalizers\WeatherNormalizeProviderInterface;
use App\Services\Weather\Unit\TemperatureUnitGuesser;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class JSONMockWeatherNormalizeProvider implements WeatherNormalizeProviderInterface
{
    public function normalize(string $data): Collection
    {
        $data = json_decode($data, true);
        if (empty($data = Arr::get($data, 'predictions'))) {
            return Collection::empty();
        }

        $scale = TemperatureUnitGuesser::guess($data['-scale']);
        $city = $data['city'];
        $date = Carbon::createFromFormat('Ymd', $data['date']);

        $collection = new Collection();

        foreach ($data['prediction'] as $prediction)
        {
            $collection->push(new WeatherPrediction(
                $date->clone()->setTimeFromTimeString($prediction['time']),
                $scale,
                $prediction['value'],
                $city
            ));
        }

        return $collection;
    }
}
