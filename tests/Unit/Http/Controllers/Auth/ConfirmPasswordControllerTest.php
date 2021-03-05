<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Http\Controllers\Auth\ConfirmPasswordController;
use Tests\Traits\ChecksMiddleware;
use Tests\Unit\AbstractUnitTest;

class ConfirmPasswordControllerTest extends AbstractUnitTest
{
    use ChecksMiddleware;

    /**
     * @test
     */
    public function it_has_the_correct_middleware(): void
    {
        $controller = new ConfirmPasswordController();

        static::assertTrue($this->middlewareContains(
            $controller->getMiddleware(),
            'auth',
        ));
    }
}
