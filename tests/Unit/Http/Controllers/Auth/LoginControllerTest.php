<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Http\Controllers\Auth\LoginController;
use Tests\Traits\ChecksMiddleware;
use Tests\Unit\AbstractUnitTest;

class LoginControllerTest extends AbstractUnitTest
{
    use ChecksMiddleware;

    /**
     * @test
     */
    public function it_has_the_correct_middleware(): void
    {
        $controller = new LoginController();

        static::assertTrue($this->middlewareContains(
            $controller->getMiddleware(),
            'guest',
            ['except' => ['logout']],
        ));
    }
}
