<?php

namespace Tests\Traits;

trait ChecksMiddleware
{
    /**
     * @param array<string, mixed>[] $middlewares
     * @param string $name
     * @param array<string, mixed> $options
     * @return bool
     */
    protected function middlewareContains(array $middlewares, string $name, array $options = []): bool
    {
        foreach ($middlewares as $middleware) {
            if (
                $middleware['middleware'] === $name
                && $middleware['options'] === $options
            ) {
                return true;
            }
        }

        return false;
    }
}
