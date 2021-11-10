<?php

namespace App\Http\Controllers;

use App\Http\Responses\AverageTemperatureResponseBuilder;
use App\Http\Validators\WeatherRequestValidator;
use App\Services\Weather\Pipeline\WeatherProcess;
use App\Services\Weather\WeatherServiceInterface;
use Carbon\Carbon;

class WeatherController extends Controller
{
    public function __construct(
        private WeatherServiceInterface $weatherService
    ) {}

    /**
     * Retrieve weather data and filter it using the user provided parameters
     *
     * @param WeatherRequestValidator $validator
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function index(WeatherRequestValidator $validator)
    {
        $data = $this->weatherService->filteredWeatherByCity(new WeatherProcess(
            $validator->one('city'),
            $validator->one('unit'),
            Carbon::createFromFormat('d/m/Y', $validator->one('date'))
        ));

        return AverageTemperatureResponseBuilder::build($data);
    }
}
