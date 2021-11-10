<?php

namespace App\Services\Weather\Pipeline;

use App\Models\Internal\WeatherPrediction;
use Carbon\Carbon;
use Closure;

class ApplyDateFilterHandler implements PipelineStepInterface
{
    /**
     * Reject all weather predictions not for the desired date
     *
     * @param WeatherProcess $process
     * @param Closure $next
     * @return mixed
     */
    public function handle(WeatherProcess $process, Closure $next)
    {
        $date = Carbon::parse($process->date);

        $process->weatherInformation = $process->weatherInformation->reject(
            function (WeatherPrediction $prediction) use ($date) {
                return ! $date->isSameDay($prediction->getDateTime());
            });

        return $next($process);
    }
}
