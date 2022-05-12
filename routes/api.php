<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\Match\HistoryController;
use App\Http\Controllers\API\Match\UpcomingController;
use App\Http\Controllers\API\RegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->group(function () {
    Route::post('login', LoginController::class)->name('login');
    Route::post('register', RegisterController::class)->name('register');

    Route::get('history', HistoryController::class)->name('history');
    Route::get('upcoming', UpcomingController::class)->name('upcoming');
});
