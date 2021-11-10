<?php

namespace App\Services\Weather\Pipeline;

use App\Services\Weather\Providers\Normalizers\WeatherNormalizeProviderInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Closure;

class NormalizeWeatherInformationHandler implements PipelineStepInterface
{
    /**
     * Normalize the fetched weather data
     *
     * @param WeatherProcess $process
     * @param Closure $next
     * @return mixed
     */
    public function handle(WeatherProcess $process, Closure $next)
    {
        foreach ($process->rawWeatherInformation as $normalizer => $data)
        {
            $process->weatherInformation->push(
                $this->normalize(app($normalizer), $data)
            );
        }

        // mark raw data for removal by garbage collector
        unset($process->rawWeatherInformation);

        // flatten the collection in order to group all predictions in one collection
        $process->weatherInformation = $process->weatherInformation->flatten(1);

        return $next($process);
    }

    /**
     * Normalize the data
     *
     * @param WeatherNormalizeProviderInterface $normalizer
     * @param string $data
     * @return Collection|null
     */
    private function normalize(WeatherNormalizeProviderInterface $normalizer, string $data): ?Collection
    {
        try {
            return $normalizer->normalize($data);
        } catch (\Throwable $e) {
            if (config('weather.dd_on_failure')) dd($e);

            Log::error("Failed to normalize data originating from fetcher assigned to " . get_class($normalizer), [
                'data' => $data
            ]);

            return null;
        }
    }
}
