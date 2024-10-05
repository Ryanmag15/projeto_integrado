<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function ($router) {
    $router->post('login', [UserController::class, 'login'])->name('login');
    $router->post('register', [UserController::class, 'register'])->name('register');
});

Route::group([    'middleware' => 'api',    'prefix' => 'auth'], function ($router) {
    $router->post('logout', [UserController::class, 'logout'])->name('logout');
    $router->post('refresh', [UserController::class, 'refresh'])->name('refresh');
    $router->post('me', [UserController::class, 'me'])->name('me');
});
