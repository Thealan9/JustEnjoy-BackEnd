<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);




Route::middleware(['auth:sanctum','active'])->group(function () {
    Route::get('/yo', fn (Request $r) => $r->user());
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::prefix('admin')->middleware('role:admin')->group(function () {

        // Vista Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // Vista Usuarios
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);

        // Servicios
        Route::get('/services', [ServiceController::class, 'index']);

        // Actividades
        Route::get('/activity', [ActivityController::class, 'index']);
    });
});
