<?php

namespace Integration\Weather;

class WeatherIntegrationTest extends \TestCase
{
    /** @test */
    public function requestFahrenheitReturnsFahrenheitUnits()
    {
        $this->get('/weather?city=AMS&date=12/01/2018&unit=F');

        $this->seeJson([
            'temperature' => 26,
            'unit' => 'F',
            'city' => 'Amsterdam',
            'date' => '12/01/2018'
        ]);
    }

    /** @test */
    public function requestCelsiusReturnsCelsiusUnits()
    {
        $this->get('/weather?city=AMS&date=12/01/2018&unit=C');

        $this->seeJson([
            'temperature' => -3,
            'unit' => 'C',
            'city' => 'Amsterdam',
            'date' => '12/01/2018'
        ]);
    }

    /** @test */
    public function requestsForDatesWithoutDataReturnNodataResponse()
    {
        $this->get('/weather?city=AMS&date=03/01/2018&unit=C');

        $this->seeJson([
            'message' => 'No data found',
            'date' => '03/01/2018'
        ]);
    }

    /** @test */
    public function requestForDatesInThePastReturnsInvalidDateResponse()
    {
        $this->get('/weather?city=AMS&date=01/01/2018&unit=C');

        $this->seeJson([
            'message' => 'Invalid date requested',
            'date' => '01/01/2018'
        ]);
    }

    /** @test */
    public function requestForDatesMoreThan10DaysIntoTheFutureReturnsInvalidDateResponse()
    {
        $this->get('/weather?city=AMS&date=13/01/2018&unit=C');

        $this->seeJson([
            'message' => 'Invalid date requested',
            'date' => '13/01/2018'
        ]);
    }
}
