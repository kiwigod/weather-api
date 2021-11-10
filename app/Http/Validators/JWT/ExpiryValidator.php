<?php

namespace App\Http\Validators\JWT;

use Carbon\Carbon;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Validation\Constraint;
use Lcobucci\JWT\Validation\ConstraintViolation;

class ExpiryValidator implements Constraint
{
    /**
     * Assert that the token has not yet expired
     *
     * @param Token $token
     * @throws \Throwable
     */
    public function assert(Token $token): void
    {
        throw_if($token->isExpired(Carbon::now()), ConstraintViolation::class);
    }
}
