<?php

namespace App\Enums;

use App\Traits\ConstantGrouping;

/**
 * All supported temperature units
 */
abstract class UnitEnum
{
    use ConstantGrouping;

    public const CELSIUS = 'C';
    public const FAHRENHEIT = 'F';
}
