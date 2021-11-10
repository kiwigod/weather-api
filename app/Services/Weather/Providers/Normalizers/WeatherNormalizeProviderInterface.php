<?php

namespace App\Services\Weather\Providers\Normalizers;

use Illuminate\Support\Collection;

interface WeatherNormalizeProviderInterface
{
    /**
     * Map the provider response to a collection of models we can work with
     *
     * @param string $data
     * @return Collection
     */
    public function normalize(string $data): Collection;
}
