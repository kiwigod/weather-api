<?php

namespace App\Http\Validators;

use App\Enums\CityEnum;
use App\Enums\UnitEnum;
use Illuminate\Validation\Rule;

class WeatherRequestValidator extends AbstractRequestValidator
{
    protected function rules(): array
    {
        return [
            'city' => ['string', 'required', Rule::in(CityEnum::allConstantValues())],
            'unit' => ['string', 'required', Rule::in(UnitEnum::allConstantValues())],
            'date' => ['date_format:d/m/Y', 'required']
        ];
    }
}
