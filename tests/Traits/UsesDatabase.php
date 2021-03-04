<?php

namespace Tests\Traits;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

trait UsesDatabase
{
    use RefreshDatabase {
        refreshTestDatabase as parentRefreshTestDatabase;
    }

    protected function refreshTestDatabase(): void
    {
        try {
            $this->parentRefreshTestDatabase();
        } catch (QueryException $exception) {
            sleep(5);
            $this->refreshTestDatabase();
        }
    }
}
