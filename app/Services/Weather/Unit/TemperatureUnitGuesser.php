<?php

namespace App\Services\Weather\Unit;

use App\Enums\UnitEnum;
use Illuminate\Support\Str;

class TemperatureUnitGuesser
{
    /**
     * Guess the temperature unit based on the input value
     *
     * @param string $input
     * @return string|null
     */
    public static function guess(string $input): ?string
    {
        if (Str::contains($input, array(UnitEnum::CELSIUS, strtolower(UnitEnum::CELSIUS)))) {
            return UnitEnum::CELSIUS;
        }

        if (Str::contains($input, array(UnitEnum::FAHRENHEIT, strtolower(UnitEnum::FAHRENHEIT)))) {
            return UnitEnum::FAHRENHEIT;
        }

        return null;
    }
}
