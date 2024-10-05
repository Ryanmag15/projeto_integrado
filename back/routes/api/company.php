<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api', 'prefix' => 'company'], function ($router) {
    $router->get('', [CompanyController::class, 'index'])->name('company.index');
    $router->get('{id}', [CompanyController::class, 'show'])->name('company.show');
    $router->post('', [CompanyController::class, 'store'])->name('company.store');
    $router->put('{id}', [CompanyController::class, 'update'])->name('company.update');
    $router->delete('{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
});
