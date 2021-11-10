<?php

namespace App\Services\Weather\Pipeline;

use DateTimeInterface;
use Illuminate\Support\Collection;

/**
 * Date warehousing object
 * Necessary to push data through the pipeline and subsequent filtering
 */
class WeatherProcess
{
    public array $rawWeatherInformation = [];

    public Collection $weatherInformation;

    public function __construct(
        public string             $city,
        // the following values are only used in post-processing pipeline
        public ?string            $desireUnit = null,
        public ?DateTimeInterface $date = null,
    ) {
        $this->weatherInformation = new Collection();
    }
}
