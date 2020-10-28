<?php

use App\Http\Controllers\JwtAuthController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get("/posts",[\App\Http\Controllers\PostController::class,"index"]);
Route::post("/posts",[\App\Http\Controllers\PostController::class,"create"]);
//Route::post("/posts",[\App\Http\Controllers\LoginController::class,"login"]);

Route::post('/login', [JwtAuthController::class,'login']);
Route::post('/register', [JwtAuthController::class,'register']);

Route::group(['middleware' => 'auth'], function () {

    Route::delete('/logout', [JwtAuthController::class,'logout']);
    Route::get('/user-info', [JwtAuthController::class,'getUser']);
});

