<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::post('register',[App\Http\Controllers\API\RegisterController::class, 'register'])->name('auth.register');

Route::post(
    'login',
    [App\Http\Controllers\API\AuthController::class, 'login']
)->name('auth.login');

Route::middleware('auth:api')->group(function (): void {
    Route::post(
        '/logout',
        [App\Http\Controllers\API\AuthController::class, 'logout']
    )->name('auth.logout');

    // Route::resource('products', App\Http\Controllers\API\ProductController::class);
});
