<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
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

/** -------------- Login -------------- **/
Route::post('/login', [LoginController::class, 'login']);
Route::post('/refresh_token', [LoginController::class, 'refreshToken']);


Route::post('/permissions/syncPermissions/{user}', [PermissionController::class, 'syncPermissions']);

Route::get('/permissions/all', [PermissionController::class, 'all']);
Route::get('/users/all', [UserController::class, 'all']);

Route::middleware(['auth'])->group(function () {
    Route::post('/revoke_refresh_token/{user}', [LoginController::class, 'revokeRefreshToken']);

    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'myPermissions']);
        Route::get('/can/{permission}', [PermissionController::class, 'canI']);
//        Route::get('/can/{permission}', [PermissionController::class, 'canI'])->middleware('can:itaque::dicta');
//        Route::get('/can', [PermissionController::class, 'canI'])->middleware('can:itaque::dicta');

//        Route::get('/{user}', [PermissionController::class, 'userPermissions']);
//        Route::get('/can/{user}/{permission}', [PermissionController::class, 'canUser']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/me', [UserController::class, 'me']);
        Route::get('', [UserController::class, 'index']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::delete('/{user}', [UserController::class, 'delete']);
        Route::delete('/{user}/destroy', [UserController::class, 'destroy']);
//        Route::delete('/{user}', [UserController::class, 'delete'])->middleware('can:delete:user');
//        Route::delete('/{user}', [UserController::class, 'delete'])->middleware('can:cum::optio');
    });
});
