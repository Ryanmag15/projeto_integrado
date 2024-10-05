<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api', 'prefix' => 'client'], function ($router) {
    $router->get('', [ClientController::class, 'index'])->name('client.index');
    $router->get('{id}', [ClientController::class, 'show'])->name('client.show');
    $router->post('', [ClientController::class, 'store'])->name('client.store');
    $router->put('{id}', [ClientController::class, 'update'])->name('client.update');
    $router->delete('{id}', [ClientController::class, 'destroy'])->name('client.destroy');
});
