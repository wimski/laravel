<?php

namespace Tests\Integration\Http\Controllers\Auth;

use App\Models\Users\User;
use Tests\Integration\AbstractIntegrationTest;

class RegisterControllerTest extends AbstractIntegrationTest
{
    /**
     * @test
     */
    public function it_registers_a_user(): void
    {
        $this->followingRedirects()->post('/register', [
            'name'                  => 'Foo Bar',
            'email'                 => 'foo@bar.com',
            'password'              => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $this->assertDatabaseHas('users', [
            'name'  => 'Foo Bar',
            'email' => 'foo@bar.com',
        ]);

        /** @var User $user */
        $user = User::where('email', 'foo@bar.com')->first();

        static::assertTrue(password_verify('12345678', $user->password));
    }
}
