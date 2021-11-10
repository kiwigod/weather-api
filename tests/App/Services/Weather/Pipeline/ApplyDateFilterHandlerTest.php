<?php

namespace App\Services\Weather\Pipeline;

use App\Models\Internal\WeatherPrediction;
use Carbon\Carbon;

class ApplyDateFilterHandlerTest extends \TestCase
{
    /** @test */
    public function verifyNonRequestedDatesAreRemoved()
    {
        $process = new WeatherProcess('AMS', 'C', Carbon::now());
        $process->weatherInformation->push(
            new WeatherPrediction(
                Carbon::now()->subDay(),
                'C',
                12,
                'AMS'
            )
        );

        (new ApplyDateFilterHandler())->handle($process, function (WeatherProcess $process) {
            $this->assertEmpty($process->weatherInformation);
        });
    }

    /** @test */
    public function verifyRequestDatesAreKept()
    {
        $process = new WeatherProcess('AMS', 'C', Carbon::now());
        $process->weatherInformation->push(
            new WeatherPrediction(
                Carbon::now(),
                'C',
                12,
                'AMS'
            )
        );

        (new ApplyDateFilterHandler())->handle($process, function (WeatherProcess $process) {
            $this->assertNotEmpty($process->weatherInformation);
        });
    }
}
