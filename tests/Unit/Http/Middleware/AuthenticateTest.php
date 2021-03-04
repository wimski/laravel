<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\Authenticate;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Mockery;
use Tests\Unit\AbstractUnitTest;

class AuthenticateTest extends AbstractUnitTest
{
    /**
     * @test
     */
    public function it_redirects_to_login_if_unautheticated_and_it_does_not_expect_json(): void
    {
        static::expectExceptionObject(new AuthenticationException('Unauthenticated.', [null], '/login'));

        $url = Mockery::mock(UrlGenerator::class, [
            'route' => '/login',
        ]);

        $request = Mockery::mock(Request::class, [
            'expectsJson' => false,
        ]);

        $middleware = new Authenticate($this->getAuth(), $url);
        $middleware->handle($request, function (){});
    }

    /**
     * @test
     */
    public function it_returns_null_if_unauthenticated_and_it_expects_json(): void
    {
        static::expectExceptionObject(new AuthenticationException('Unauthenticated.', [null], null));

        $request = Mockery::mock(Request::class, [
            'expectsJson' => true,
        ]);

        $middleware = new Authenticate($this->getAuth(), Mockery::mock(UrlGenerator::class));
        $middleware->handle($request, function (){});
    }

    protected function getAuth(): Auth
    {
        $guard = Mockery::mock(Guard::class, [
            'check' => false,
        ]);

        return Mockery::mock(Auth::class, [
            'guard' => $guard,
        ]);
    }
}
