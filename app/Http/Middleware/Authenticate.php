<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Routing\UrlGenerator;

class Authenticate extends Middleware
{
    protected UrlGenerator $urlGenerator;

    public function __construct(Auth $auth, UrlGenerator $urlGenerator)
    {
        parent::__construct($auth);

        $this->urlGenerator = $urlGenerator;
    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return $this->urlGenerator->route('login');
        }

        return null;
    }
}
