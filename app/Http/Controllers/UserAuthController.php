<?php

namespace App\Http\Controllers;

use App\Http\Validators\UserAuthorizationValidator;
use App\Services\User\UserAuthorizationService;

class UserAuthController extends Controller
{
    public function __construct(
        private UserAuthorizationService $userAuthorizationService
    ) {}

    /**
     * Validate the user by email and password
     * When validation succeeds a bearer token is returned which can be used for subsequent requests to guarded endpoints
     *
     * @param UserAuthorizationValidator $validator
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Throwable
     */
    public function auth(UserAuthorizationValidator $validator)
    {
        $token = $this->userAuthorizationService->makeTokenForUser(
            $this->userAuthorizationService->authenticateUser($validator->one('email'), $validator->one('password'))
        );

        return response([
            'token' => $token->toString(),
        ]);
    }
}
