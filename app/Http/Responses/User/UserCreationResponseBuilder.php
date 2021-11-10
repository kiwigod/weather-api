<?php

namespace App\Http\Responses\User;

use App\Http\Responses\AbstractResponseBuilder;

class UserCreationResponseBuilder extends AbstractResponseBuilder
{
    public function transform($data): array
    {
        return [
            'id' => $data
        ];
    }
}
