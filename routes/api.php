<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group( function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::middleware('auth:sanctum')->post('/user/search', [UserController::class, 'search']);
    Route::middleware('auth:sanctum')->post('/message/like/{message}', [MessageController::class, 'like']);
    Route::middleware('auth:sanctum')->post('/message/unlike/{message}', [MessageController::class, 'unlike']);
    Route::middleware('auth:sanctum')->post('/message/report/{message}', [MessageController::class, 'report']);
});
