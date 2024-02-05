<?php

use App\Http\Controllers\{
    FollowerController,
    FollowingController,
    MessageController,
    PageController,
    ProfileController,
    UserController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'home'])->name('home');

Route::middleware(['auth', 'verified'])->group( function() {
    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::post('/message', [MessageController::class, 'store'])->name('message.store');

    Route::get('/followers', [FollowerController::class, 'index'])->name('followers');

    Route::get('/following', [FollowingController::class, 'index'])->name('following');
    Route::post('/following/{id}', [FollowingController::class, 'store'])->name('following.store');
    Route::delete('/following/{id}', [FollowingController::class, 'destroy'])->name('following.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
