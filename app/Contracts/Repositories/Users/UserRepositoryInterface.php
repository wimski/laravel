<?php

namespace App\Contracts\Repositories\Users;

use App\Models\Users\User;

interface UserRepositoryInterface
{
    /**
     * @param array<string, mixed> $attributes
     * @return User
     */
    public function create(array $attributes): User;
}
