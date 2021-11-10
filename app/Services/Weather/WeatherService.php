<?php

namespace App\Services\Weather;

use App\Services\Weather\Pipeline\WeatherProcess;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;

class WeatherService implements WeatherServiceInterface
{
    public function __construct(
        private array $steps,
        private array $filterSteps,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function weatherByCity(string $city): Collection
    {
        $process = new WeatherProcess($city);

        /** @var WeatherProcess $data */
        $data = app(Pipeline::class)
            ->send($process)
            ->through($this->steps)
            ->thenReturn();

        return $data->weatherInformation;
    }

    /**
     * {@inheritDoc}
     */
    public function filteredWeatherByCity(WeatherProcess $process): Collection
    {
        /** @var WeatherProcess $data */
        $data = app(Pipeline::class)
            ->send($process)
            ->through($this->filterSteps)
            ->thenReturn();

        return $data->weatherInformation;
    }
}
