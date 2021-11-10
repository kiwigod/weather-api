<?php

namespace App\Services\Weather\Unit;

class CelsiusTest extends \TestCase
{
    /** @test */
    public function verifyCelsiusToFahrenheitConversion()
    {
        $this->assertEquals(
            53.6,
            (new Celsius(12))->to('F')
        );
    }
}
