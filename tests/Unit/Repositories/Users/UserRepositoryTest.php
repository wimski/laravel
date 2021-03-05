<?php

namespace Tests\Unit\Repositories\Users;

use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use Mockery;
use Tests\Unit\AbstractUnitTest;

class UserRepositoryTest extends AbstractUnitTest
{
    /**
     * @test
     */
    public function it_relays_the_create_method_to_the_eloquent_resource(): void
    {
        /** @var User $resource */
        $resource = Mockery::mock(User::class)
            ->shouldReceive('create')
            ->with(['foo' => 'bar'])
            ->andReturnSelf()
            ->getMock();

        $repository = new UserRepository($resource);
        $repository->create(['foo' => 'bar']);
    }
}
