<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Configuration;

class UserAuthorizationServiceTest extends \TestCase
{
    private UserAuthorizationService $userAuthorizationService;
    private $userRepository;

    protected function setUp(): void
    {
        $this->createApplication();

        $this->userAuthorizationService = new UserAuthorizationService(
            $this->userRepository = \Mockery::instanceMock(UserRepository::class),
            app(Configuration::class),
            app(Builder::class)
        );
    }

    /** @test */
    public function verifyUserAuthenticationPassesWithCorrectPassword()
    {
        $user = User::factory()->make();
        $user->password = Hash::make('seohyun');

        $this->userRepository->shouldReceive('findByEmail')->andReturn($user);

        $this->assertEquals($user, $this->userAuthorizationService->authenticateUser('', 'seohyun'));
    }

    /** @test */
    public function verifyUserAuthenticationFailsWithIncorrectPassword()
    {
        $user = User::factory()->make();
        $user->password = Hash::make('kiwi');

        $this->userRepository->shouldReceive('findByEmail')->andReturn($user);

        $this->expectException(UnauthorizedException::class);
        $this->userAuthorizationService->authenticateUser('', 'seohyun');
    }
}
