<?php

namespace App\Services\Weather\Pipeline;

use App\Models\Internal\WeatherPrediction;
use App\Services\Weather\Unit\TemperatureUnitConversion;
use Closure;

class TemperatureUnitConversionHandler implements PipelineStepInterface
{
    /**
     * Convert the weather prediction unit to the desired unit
     *
     * @param WeatherProcess $process
     * @param Closure $next
     * @return mixed
     */
    public function handle(WeatherProcess $process, Closure $next)
    {
        $unit = $process->desireUnit;

        $process->weatherInformation = $process->weatherInformation->map(function (WeatherPrediction $prediction) use ($unit) {
            if ($prediction->getTemperatureUnit() !== $unit) {
                $prediction->setTemperature(TemperatureUnitConversion::from($prediction)->to($unit))
                    ->setTemperatureUnit($unit);
            }

            return $prediction;
        });

        return $next($process);
    }
}
