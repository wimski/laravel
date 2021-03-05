<?php

namespace Tests\Integration\Repositories\Users;

use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use Tests\Integration\AbstractIntegrationTest;

class UserRepositoryTest extends AbstractIntegrationTest
{
    /**
     * @test
     */
    public function it_creates_a_user(): void
    {
        $repository = new UserRepository(new User());

        $repository->create([
            'name'     => 'John Doe',
            'email'    => 'johndoe@gmail.com',
            'password' => 'secret',
        ]);

        $this->assertDatabaseHas('users', [
            'name'     => 'John Doe',
            'email'    => 'johndoe@gmail.com',
            'password' => 'secret',
        ]);
    }
}
