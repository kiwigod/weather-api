<?php

namespace App\Http\Validators;

use Illuminate\Validation\Rules\Password;

class UserCreationValidator extends AbstractRequestValidator
{
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', 'confirmed', Password::min(6)]
        ];
    }
}
