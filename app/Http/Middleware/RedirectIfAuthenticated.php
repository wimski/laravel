<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class RedirectIfAuthenticated
{
    protected Auth $auth;

    protected Redirector $redirector;

    public function __construct(Auth $auth, Redirector $redirector)
    {
        $this->auth       = $auth;
        $this->redirector = $redirector;
    }

    /**
     * @param Request     $request
     * @param Closure     $next
     * @param string|null ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ?string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->redirector->to(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
