<?php

namespace App\Http\Responses\User;

use App\Http\Responses\AbstractResponseBuilder;
use Lcobucci\JWT\Token;

class UserAuthorizationResponseBuilder extends AbstractResponseBuilder
{
    /**
     * @param Token $data
     * @return array
     */
    public function transform($data): array
    {
        return [
            'token' => $data->toString(),
            'expires_at' => $data->claims()->get('exp')->format('Y/m/d\Th:i:s\Z'),
            'type' => 'bearer'
        ];
    }
}
