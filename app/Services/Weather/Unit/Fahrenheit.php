<?php

namespace App\Services\Weather\Unit;

use App\Enums\UnitEnum;

class Fahrenheit extends UnitConverter
{
    public function to(string $unit): float
    {
        if ($unit === UnitEnum::FAHRENHEIT) return $this->value;

        switch ($unit) {
            case UnitEnum::CELSIUS:
                return $this->celsius();
        }

        throw new \Exception(sprintf("Conversion from %s to %s is not supported", UnitEnum::FAHRENHEIT, $unit));
    }

    private function celsius(): float
    {
        return ($this->value - 32) * 5 / 9;
    }
}
