<?php

namespace App\Repositories\Users;

use App\Contracts\Repositories\Users\UserRepositoryInterface;
use App\Models\Users\User;

class UserRepository implements UserRepositoryInterface
{
    protected User $resource;

    public function __construct(User $resource)
    {
        $this->resource = $resource;
    }

    public function create(array $attributes): User
    {
        return $this->resource::create($attributes);
    }
}
