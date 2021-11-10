<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class InvalidValidatorKeyException extends \Exception
{
    public function __construct(string $key)
    {
        parent::__construct("Cannot retrieve key ($key) from validator (" . get_called_class() . ").");
    }
}
