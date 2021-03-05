<?php

use App\Http\Controllers\HomeController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'confirm' => true,
    'verify'  => true,
]);

Route::get(RouteServiceProvider::HOME, [HomeController::class, 'index'])->name('home');
