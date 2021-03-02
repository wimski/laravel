<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get(RouteServiceProvider::HOME, function () {
    return new JsonResponse();
});
