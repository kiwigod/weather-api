<?php

namespace App\Services\Weather\Unit;

use App\Enums\UnitEnum;
use App\Models\Internal\WeatherPrediction;
use App\Services\Weather\Unit\Celsius;
use App\Services\Weather\Unit\Fahrenheit;
use App\Services\Weather\Unit\UnitConverter;

abstract class TemperatureUnitConversion
{
    /**
     * Create a temperature unit conversion instance for the origin unit and temperature value.
     * A more appropriate solution to better adhere to the single responsibility principle would be to create a separate
     * conversion class for each conversion direction. e.g. celsius to target unit.
     *
     * @param WeatherPrediction $prediction
     * @return UnitConverter
     * @throws \Exception
     */
    public static function from(WeatherPrediction $prediction): UnitConverter
    {
        switch ($prediction->getTemperatureUnit())
        {
            case UnitEnum::CELSIUS:
                return new Celsius($prediction->getTemperature());
            case UnitEnum::FAHRENHEIT:
                return new Fahrenheit($prediction->getTemperature());
        }

        throw new \Exception(sprintf("Converter for %s is not defined", $prediction->getTemperatureUnit()));
    }
}
