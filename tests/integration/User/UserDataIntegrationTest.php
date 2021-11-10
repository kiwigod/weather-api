<?php

namespace Integration\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;

class UserDataIntegrationTest extends \TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function passwordIsOmittedFromUserDataResponse()
    {
        $user = User::factory()->create([
            'name' => 'Seohyun',
            'email' => 'kiwi@co.com',
            'password' => Hash::make('qwerty123')
        ]);

        $this->actingAs($user);
        $this->get('/user');

        $this->dontSeeJson(['password']);
    }

    /** @test */
    public function userDataCanOnlyBeRequestedWhenAuthenticated()
    {
        $this->get('/user');

        $this->assertResponseStatus(401);
    }
}
