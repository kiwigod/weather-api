<?php

namespace App\Http\Validators;

class UserAuthorizationValidator extends AbstractRequestValidator
{
    protected function rules(): array
    {
        return [
            'email' => ['email', 'required'],
            'password' => ['string', 'required']
        ];
    }
}
