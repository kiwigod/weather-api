<?php

namespace App\Services\Weather\Unit;

class FahrenheitTest extends \TestCase
{
    /** @test */
    public function verifyFahrenheitToCelsiusConversion()
    {
        $this->assertEquals(
            -11.11111111111111,
            (new Fahrenheit(12))->to('C')
        );
    }
}
