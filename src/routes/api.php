<?php

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')
    ->name('api.v1.')
    ->namespace('App\Http\Controllers\Api\V1')
    ->group(function () {
        require __DIR__ . '/auth.php';

        Route::get('/user', static function (Request $request) {
            return $request->user();
        })->name('auth.user');

        Route::middleware(['auth'])
            ->group(function () {
                Route::get('/users', [UserController::class, 'index'])->name('users.index');
                Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
                Route::post('/users', [UserController::class, 'store'])->name('users.store');
                Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            });
    });
