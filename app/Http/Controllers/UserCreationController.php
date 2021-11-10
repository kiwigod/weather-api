<?php

namespace App\Http\Controllers;

use App\Http\Responses\User\UserCreationResponseBuilder;
use App\Http\Validators\UserCreationValidator;
use App\Services\User\UserCreationService;

class UserCreationController extends Controller
{
    public function __construct(
        private UserCreationService $userCreationService
    ) {}

    /**
     * Create a user with the given validator
     *
     * @param UserCreationValidator $validator
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Throwable
     */
    public function create(UserCreationValidator $validator)
    {
        return UserCreationResponseBuilder::build($this->userCreationService->saveUserFromValidator($validator));
    }
}
