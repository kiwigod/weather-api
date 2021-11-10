<?php

namespace App\Traits;

trait ConstantGrouping
{
    public static function allConstantValues(): array
    {
        return array_values((new \ReflectionClass(self::class))->getConstants());
    }

    public static function allConstantKeys(): array
    {
        return array_keys((new \ReflectionClass(self::class))->getConstants());
    }
}
