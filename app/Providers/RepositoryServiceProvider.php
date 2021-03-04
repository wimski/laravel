<?php

namespace App\Providers;

use App\Contracts\Repositories\Users\UserRepositoryInterface;
use App\Repositories\Users\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array<string, string>
     */
    protected array $repositories = [
        UserRepositoryInterface::class => UserRepository::class,
    ];

    public function register()
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->singleton($interface, $repository);
        }
    }
}
