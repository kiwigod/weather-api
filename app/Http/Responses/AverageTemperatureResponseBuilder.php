<?php

namespace App\Http\Responses;

use App\Models\Internal\WeatherPrediction;
use Illuminate\Support\Collection;

class AverageTemperatureResponseBuilder extends AbstractResponseBuilder
{
    protected static bool $shouldIterateIterable = false;

    /**
     * Reduce and calculate the average temperature
     *
     * @param Collection $data
     * @return array
     */
    public function transform($data): array
    {
        if ($data->isEmpty())
        {
            return ['message' => 'No data found', 'date' => app('request')->get('date')];
        }

        /** @var WeatherPrediction $prediction */
        $prediction = $data[0];

        $average = $data->reduce(function ($carry, WeatherPrediction $prediction) {
            return $carry + $prediction->getTemperature();
        }) / count($data);

        return [
            'temperature' => round($average),
            'unit' => $prediction->getTemperatureUnit(),
            'city' => $prediction->getCity(),
            'date' => $prediction->getDateTime()->format('d/m/Y')
        ];
    }
}
