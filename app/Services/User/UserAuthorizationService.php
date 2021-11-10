<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Token;

class UserAuthorizationService
{
    public function __construct(
        private UserRepository $userRepository,
        private Configuration $configuration,
        private Builder $builder
    ) {}

    /**
     * Create a token for the specified user
     *
     * @param User $user
     * @return Token
     */
    public function makeTokenForUser(User $user): Token
    {
        return $this->builder
            ->withClaim('uid', $user->id)
            ->getToken($this->configuration->signer(), $this->configuration->signingKey());
    }

    /**
     * Authenticate the user identified by the email
     *
     * @param string $email
     * @param string $password
     * @return User
     * @throws \Throwable
     */
    public function authenticateUser(string $email, string $password): User
    {
        $user = $this->userRepository->findByEmail($email);

        throw_unless(Hash::check($password, $user?->getAuthPassword()), UnauthorizedException::class);

        return $user;
    }
}
