<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api', 'prefix' => 'task'], function ($router) {
    $router->get('', [TaskController::class, 'index'])->name('task.index');
    $router->get('{id}', [TaskController::class, 'show'])->name('task.show');
    $router->post('', [TaskController::class, 'store'])->name('task.store');
    $router->put('{id}', [TaskController::class, 'update'])->name('task.update');
    $router->delete('{id}', [TaskController::class, 'destroy'])->name('task.destroy');
});
