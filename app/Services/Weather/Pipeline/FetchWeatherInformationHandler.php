<?php

namespace App\Services\Weather\Pipeline;

use App\Services\Weather\Providers\Fetchers\WeatherFetchProviderInterface;
use Illuminate\Support\Facades\Log;
use Closure;

class FetchWeatherInformationHandler implements PipelineStepInterface
{
    /**
     * Fetch data from the providers which provide data for the requested city
     *
     * @param WeatherProcess $process
     * @param Closure $next
     * @return mixed
     */
    public function handle(WeatherProcess $process, Closure $next)
    {
        foreach (config('weather.providers') as $fetcher => $normalizer)
        {
            if (in_array($process->city, call_user_func(array($fetcher, 'providesCities'))))
            {
                if (empty($data = $this->fetch(app($fetcher), $process->city)))
                {
                    continue;
                }

                $process->rawWeatherInformation[$normalizer] = $data;
            }
        }

        return $next($process);
    }

    /**
     * Fetch the weather data for the given provider
     *
     * @param WeatherFetchProviderInterface $provider
     * @param string $city
     * @return string
     */
    private function fetch(WeatherFetchProviderInterface $provider, string $city): string
    {
        try {
            return $provider->fetchWeatherData($city);
        } catch (\Throwable $e) {
            if (config('weather.dd_on_failure')) dd($e);

            Log::error("Failed to retrieve data for provider " . get_class($provider));

            return "";
        }
    }
}
