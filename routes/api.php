<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaketController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//prefix auth 
Route::group([ 'middleware' => 'api', 'prefix' => 'auth' ], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

//prefix paket
Route::group([ 'middleware' => 'api', 'prefix' => 'paket' ], function ($router) {
    Route::get('/', [PaketController::class, 'index']);
    Route::post('/', [PaketController::class, 'create']);
    Route::get('/{id}', [PaketController::class, 'view']);
    Route::post('/{id}', [PaketController::class, 'update']);
    //delete paket
    Route::delete('/{id}', [PaketController::class, 'delete']);
});

Route::post('/upload-image', [PaketController::class, 'uploadImage']);

