<?php

namespace App\Models\Internal;

use App\Enums\UnitEnum;
use App\Services\Weather\Unit\TemperatureUnitConversion;
use DateTimeInterface;

class WeatherPrediction
{
    public function __construct(
        private DateTimeInterface $dateTime,
        private string $temperatureUnit,
        private float $temperature,
        private string $city
    ) {
        // When instantiating we want to primarily work with celsius and apply conversions when filtering.
        $this->temperature = TemperatureUnitConversion::from($this)->to(UnitEnum::CELSIUS);
    }

    /**
     * @return string
     */
    public function getTemperatureUnit(): string
    {
        return $this->temperatureUnit;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $temperatureUnit
     * @return WeatherPrediction
     */
    public function setTemperatureUnit(string $temperatureUnit): WeatherPrediction
    {
        $this->temperatureUnit = $temperatureUnit;
        return $this;
    }

    /**
     * @param float $temperature
     * @return WeatherPrediction
     */
    public function setTemperature(float $temperature): WeatherPrediction
    {
        $this->temperature = $temperature;
        return $this;
    }
}
