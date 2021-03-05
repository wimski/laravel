<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::get(RouteServiceProvider::HOME, function () {
    return view('base');
});
