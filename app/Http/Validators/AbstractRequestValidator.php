<?php

namespace App\Http\Validators;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

abstract class AbstractRequestValidator
{
    use ProvidesConvenienceMethods;

    private Request $request;

    /**
     * Validate the incoming request against the defined rules
     *
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate($this->request = $request, $this->rules());
    }

    /**
     * Retrieve a request parameter
     *
     * @param string $name
     * @return mixed
     */
    public function one(string $name): mixed
    {
        return $this->request->get($name);
    }

    /**
     * Retrieve all request parameters
     *
     * @return array
     */
    public function all(): array
    {
        return $this->request->all(array_keys($this->rules()));
    }

    /**
     * Validation rules
     *
     * @return array
     */
    abstract protected function rules(): array;
}
