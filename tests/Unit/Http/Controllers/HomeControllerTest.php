<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\HomeController;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Mockery;
use Mockery\MockInterface;
use Tests\Traits\ChecksMiddleware;
use Tests\Unit\AbstractUnitTest;

class HomeControllerTest extends AbstractUnitTest
{
    use ChecksMiddleware;

    protected HomeController $controller;

    /**
     * @var ViewFactory|MockInterface
     */
    protected $viewFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->viewFactory = Mockery::mock(ViewFactory::class);
        $this->controller  = new HomeController($this->viewFactory);
    }

    /**
     * @test
     */
    public function it_has_the_correct_middleware(): void
    {
        static::assertTrue($this->middlewareContains(
            $this->controller->getMiddleware(),
            'auth',
        ));
    }

    /**
     * @test
     */
    public function it_returns_the_home_view(): void
    {
        $this->viewFactory
            ->shouldReceive('make')
            ->with('home')
            ->andReturn(Mockery::mock(View::class))
            ->getMock();

        $this->controller->index();
    }
}
