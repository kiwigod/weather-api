<?php

namespace App\Services\Weather\Pipeline;

use Closure;

interface PipelineStepInterface
{
    /**
     * The logic to apply to the process
     *
     * @param WeatherProcess $process
     * @param Closure $next
     * @return mixed
     */
    public function handle(WeatherProcess $process, Closure $next);
}
