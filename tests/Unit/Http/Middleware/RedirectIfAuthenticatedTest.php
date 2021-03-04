<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Mockery;
use Tests\Unit\AbstractUnitTest;

class RedirectIfAuthenticatedTest extends AbstractUnitTest
{
    /**
     * @test
     */
    public function it_redirects_if_authenticated(): void
    {
        $redirect = Mockery::mock(Redirector::class, [
            'to' => Mockery::mock(RedirectResponse::class),
        ]);

        $middleware = new RedirectIfAuthenticated($this->getAuth(true), $redirect);

        $return = $middleware->handle(Mockery::mock(Request::class), function (){}, 'guard-name');

        static::assertInstanceOf(RedirectResponse::class, $return);
    }

    /**
     * @test
     */
    public function it_calls_closure_if_not_authenticated(): void
    {
        $request = Mockery::mock(Request::class);

        $middleware = new RedirectIfAuthenticated($this->getAuth(false), Mockery::mock(Redirector::class));

        $return = $middleware->handle($request, function (Request $request) {
            return $request;
        }, 'guard-name');

        static::assertSame($request, $return);
    }

    protected function getAuth(bool $status): Auth
    {
        $guard = Mockery::mock(Guard::class, [
            'check' => $status,
        ]);

        return Mockery::mock(Auth::class, [
            'guard' => $guard,
        ]);
    }
}
