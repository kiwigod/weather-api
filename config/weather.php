<?php

use App\Services\Weather\Providers\Fetchers\Mock\CSVMockWeatherFetchProvider;
use App\Services\Weather\Providers\Fetchers\Mock\JSONMockWeatherFetchProvider;
use App\Services\Weather\Providers\Fetchers\Mock\XMLMockWeatherFetchProvider;
use App\Services\Weather\Providers\Normalizers\Mock\CSVMockWeatherNormalizeProvider;
use App\Services\Weather\Providers\Normalizers\Mock\JSONMockWeatherNormalizeProvider;
use App\Services\Weather\Providers\Normalizers\Mock\XMLMockWeatherNormalizeProvider;

return [
    /**
     * Whether the weather processing request should halt and dump process information on provider failure
     */
    'dd_on_failure' => env('APP_DEBUG') == 'true',

    /**
     * Number of seconds the data should be allowed to persist in cache
     */
    'cache_ttl' => 60,

    /**
     * Register all fetch providers along with their respective normalizer
     * We only register mock providers in local and development environments
     */
    'providers' => array_merge(app()->environment(['local', 'development', 'testing']) ? [
        CSVMockWeatherFetchProvider::class => CSVMockWeatherNormalizeProvider::class,
        JSONMockWeatherFetchProvider::class => JSONMockWeatherNormalizeProvider::class,
        XMLMockWeatherFetchProvider::class => XMLMockWeatherNormalizeProvider::class
    ] : [], [
        // register non mock providers here
    ])
];
