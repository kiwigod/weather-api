<?php

namespace App\Http\Controllers;

use App\Http\Responses\AverageTemperatureResponseBuilder;
use App\Http\Responses\InvalidDateResponseBuilder;
use App\Http\Validators\WeatherRequestValidator;
use App\Services\Weather\Pipeline\WeatherProcess;
use App\Services\Weather\WeatherServiceInterface;
use Carbon\Carbon;
use DateTimeInterface;

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
        if (! $this->validateDateIsInRange($date = Carbon::createFromFormat('d/m/Y', $validator->one('date')))) {
            return InvalidDateResponseBuilder::build($date);
        }

        $data = $this->weatherService->filteredWeatherByCity(new WeatherProcess(
            $validator->one('city'),
            $validator->one('unit'),
            $date
        ));

        return AverageTemperatureResponseBuilder::build($data);
    }

    /**
     * Validate the requested date.
     * The basic validation rules of Illuminate do not support this
     *
     * @param DateTimeInterface $date
     * @return bool
     */
    private function validateDateIsInRange(DateTimeInterface $date): bool
    {
        $now = match (app()->environment()) {
            'local', 'testing' => Carbon::create(2018, 1, 2)->endOfDay(),
            default => Carbon::now()->endOfDay(),
        };

        /**
         * Date is valid when it's the same as the current date.
         * Date is valid when it's at most 10 days into the future
         */
        return $now->isSameDay($date) || ($now->isBefore($date) && $now->addDays(10)->isAfter($date));
    }
}
