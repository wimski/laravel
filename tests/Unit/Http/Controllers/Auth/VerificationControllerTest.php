<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Http\Controllers\Auth\VerificationController;
use Tests\Traits\ChecksMiddleware;
use Tests\Unit\AbstractUnitTest;

class VerificationControllerTest extends AbstractUnitTest
{
    use ChecksMiddleware;

    /**
     * @test
     */
    public function it_has_the_correct_middleware(): void
    {
        $middleware = (new VerificationController())->getMiddleware();

        static::assertTrue($this->middlewareContains(
            $middleware,
            'auth',
        ));

        static::assertTrue($this->middlewareContains(
            $middleware,
            'signed',
            ['only' => ['verify']],
        ));

        static::assertTrue($this->middlewareContains(
            $middleware,
            'throttle:6,1',
            ['only' => ['verify', 'resend']],
        ));
    }
}
