<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    protected ViewFactory $view;

    public function __construct(ViewFactory $view)
    {
        $this->view = $view;

        $this->middleware('auth');
    }

    public function index(): View
    {
        return $this->view->make('home');
    }
}
