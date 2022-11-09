<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PublisherController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::prefix('book')->controller(BookController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/detail', 'show');
    Route::put('/update', 'update');
    Route::post('/create', 'store');
    Route::delete('/delete', 'destroy');
});


Route::prefix('author')->controller(AuthorController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/detail', 'show');
    Route::put('/update', 'update');
    Route::post('/create', 'store');
    Route::delete('/delete','destroy');
});

Route::prefix('publisher')->controller(PublisherController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/detail', 'show');
    Route::put('/update', 'update');
    Route::post('/create', 'store');
    Route::delete('/delete','destroy');
});