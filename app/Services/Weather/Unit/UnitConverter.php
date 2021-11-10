<?php

namespace App\Services\Weather\Unit;

abstract class UnitConverter
{
    public function __construct(
        protected float $value
    ) {}

    /**
     * Convert the current value to the desired target unit
     *
     * @param string $unit
     * @return float
     */
    public abstract function to(string $unit): float;
}
