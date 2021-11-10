<?php

namespace App\Services\Weather\Pipeline;

use App\Enums\CityEnum;
use App\Services\Weather\Providers\Normalizers\Mock\CSVMockWeatherNormalizeProvider;
use App\Services\Weather\Providers\Normalizers\Mock\JSONMockWeatherNormalizeProvider;
use App\Services\Weather\Providers\Normalizers\Mock\XMLMockWeatherNormalizeProvider;

class FetchWeatherInformationHandlerTest extends \TestCase
{
    /** @test */
    public function verifyDataIsRetrievedAndPreparedForNormalization()
    {
        $process = new WeatherProcess(CityEnum::AMS);

        (new FetchWeatherInformationHandler())->handle($process, function (WeatherProcess $process) {
            $this->assertArrayHasKey(CSVMockWeatherNormalizeProvider::class, $process->rawWeatherInformation);
            $this->assertArrayHasKey(JSONMockWeatherNormalizeProvider::class, $process->rawWeatherInformation);
            $this->assertArrayHasKey(XMLMockWeatherNormalizeProvider::class, $process->rawWeatherInformation);
        });
    }
}
