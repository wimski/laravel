<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\TrustHosts;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Foundation\Application;
use Mockery;
use Mockery\MockInterface;
use Tests\Unit\AbstractUnitTest;

class TrustHostsTest extends AbstractUnitTest
{
    /**
     * @test
     */
    public function it_trusts_the_correct_hosts(): void
    {
        /** @var Config|MockInterface $config */
        $config = Mockery::mock(Config::class, [
            'get' => 'https://www.foobar.com',
        ]);

        /** @var Application|MockInterface $app */
        $app = Mockery::mock(Application::class, [
            'offsetGet' => $config,
        ]);

        $middleware = new TrustHosts($app);

        static::assertSame(['^(.+\.)?www\.foobar\.com$'], $middleware->hosts());
    }
}
