<?php

namespace App\Services\Weather\Pipeline;

use App\Enums\CityEnum;
use App\Models\Internal\WeatherPrediction;
use Carbon\Carbon;

class NormalizeWeatherInformationHandlerTest extends \TestCase
{
    /** @test */
    public function verifyNormalizerOutputsWeatherPredictionModels()
    {
        $process = new WeatherProcess(CityEnum::AMS, null, Carbon::now());

        (new FetchWeatherInformationHandler())->handle($process, function (WeatherProcess $receivedProcess) use (&$process) {
            $process = $receivedProcess;
        });

        (new NormalizeWeatherInformationHandler())->handle($process, function (WeatherProcess $process) {
            $this->assertInstanceOf(WeatherPrediction::class, $process->weatherInformation->first());
        });
    }
}
