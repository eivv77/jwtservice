<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/user/register', [AuthController::class, 'register']);
    Route::post('/user/login', [AuthController::class, 'login']);
    Route::post('/user/logout', [AuthController::class, 'logout']);

    Route::post('/store', [BookController::class, 'store']);
    Route::post('/store', [RatingController::class, 'store']);
    Route::get('/index', [BookController::class, 'index']);
    Route::get('/show', [BookController::class, 'show']);


});

    Route::apiResource('books', 'BookController');
    Route::post('books/{book}/ratings', 'RatingController@store');



//Route::post('/user/register', [AuthController::class,'register']);
