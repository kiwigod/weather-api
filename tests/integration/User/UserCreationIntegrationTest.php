<?php

namespace Integration\User;

use Laravel\Lumen\Testing\DatabaseMigrations;

class UserCreationIntegrationTest extends \TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function verifyUserIsStoredCorrectly()
    {
        $this->post('/user', [
            'name' => 'Jun',
            'email' => 'kiwi@meow.co',
            'password' => 'hello123',
            'password_confirmation' => 'hello123'
        ]);

        $this->assertResponseOk();

        $this->seeJson([
            'id' => 1
        ]);

        $this->seeInDatabase('users', [
            'name' => 'Jun',
            'email' => 'kiwi@meow.co'
        ]);
    }

    /** @test */
    public function verifyValidationErrors()
    {
        $this->post('/user', []);

        $this->seeJson([
            'name' => ['The name field is required.'],
            'email' => ['The email field is required.'],
            'password' => ['The password field is required.']
        ]);
    }

    /** @test */
    public function verifyPasswordConfirmationIsRequired()
    {
        $this->post('/user', [
            'name' => 'Jun',
            'email' => 'kiwi@meow.co',
            'password' => 'yeeee123',
        ]);

        $this->seeJson(['password' => ['The password confirmation does not match.']]);
    }
}
