<?php

namespace App\Services\User;

use App\Http\Validators\UserCreationValidator;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserCreationService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    /**
     * Save a user created from request
     *
     * @param UserCreationValidator $validator
     * @return int
     * @throws \Throwable
     */
    public function saveUserFromValidator(UserCreationValidator $validator): int
    {
        $user = new User([
            'name' => $validator->one('name'),
            'email' => $validator->one('email'),
        ]);

        $user->password = Hash::make($validator->one('password'));

        return $this->userRepository->store($user);
    }
}
