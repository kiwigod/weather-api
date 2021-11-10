<?php

namespace App\Services\Weather\Providers\Normalizers\Mock;

use App\Models\Internal\WeatherPrediction;
use App\Services\Weather\Providers\Normalizers\WeatherNormalizeProviderInterface;
use App\Services\Weather\Unit\TemperatureUnitGuesser;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CSVMockWeatherNormalizeProvider implements WeatherNormalizeProviderInterface
{
    private const HEADER = [
        'scale' => 0,
        'city' => 1,
        'date' => 2,
        'prediction_time' => 3,
        'prediction_value' => 4
    ];

    public function normalize(string $data): Collection
    {
        // remove the header as we hardcoded it
        $data = preg_split('#\n#', $data);
        unset($data[0]);

        // these variables are only set on the first line of the response and should therefore keep track of them
        $datetime = null;
        $scale = null;
        $city = null;

        $collection = new Collection();

        foreach ($data as $line)
        {
            // remove excessive annotations
            $line = array_map(fn($item) => trim($item, "\""), explode(',', $line));

            if (empty($line) || count($line) !== count(self::HEADER))
            {
                continue;
            }

            if (empty($datetime))
            {
                $datetime = Carbon::createFromFormat('Ymd h:i', implode(' ', array($line[self::HEADER['date']], $line[self::HEADER['prediction_time']])));
            }

            $collection->push(new WeatherPrediction(
                $datetime->clone()->setTimeFromTimeString($line[self::HEADER['prediction_time']]),
                $scale = TemperatureUnitGuesser::guess($line[self::HEADER['scale']]) ?: $scale,
                intval($line[self::HEADER['prediction_value']]),
                $city = $line[self::HEADER['city']] ?: $city
            ));
        }

        return $collection;
    }
}
