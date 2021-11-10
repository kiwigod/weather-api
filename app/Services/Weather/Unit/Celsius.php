<?php

namespace App\Services\Weather\Unit;

use App\Enums\UnitEnum;

class Celsius extends UnitConverter
{
    public function to(string $unit): float
    {
        if ($unit === UnitEnum::CELSIUS) return $this->value;

        switch ($unit) {
            case UnitEnum::FAHRENHEIT:
                return $this->fahrenheit();
        }

        throw new \Exception(sprintf("Conversion from %s to %s is not supported", UnitEnum::CELSIUS, $unit));
    }

    private function fahrenheit(): float
    {
        return $this->value * 9 / 5 + 32;
    }
}
