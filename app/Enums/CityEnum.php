<?php

namespace App\Enums;

use App\Traits\ConstantGrouping;

/**
 * All cities with weather data retrieval supported by the API
 */
abstract class CityEnum
{
    use ConstantGrouping;

    public const AMS = 'AMS';
}
