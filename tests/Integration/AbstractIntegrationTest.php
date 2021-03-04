<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\TestCase;
use Tests\Traits\CreatesApplication;
use Tests\Traits\UsesDatabase;

abstract class AbstractIntegrationTest extends TestCase
{
    use CreatesApplication;
    use UsesDatabase;
}
