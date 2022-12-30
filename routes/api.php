<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;

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

Route::middleware('auth:sanctum')->get('/user',

 function (Request $request) {
    return $request->user();
});
Route::post('login',[AuthController::class,'login']);

Route::group(['middleware' => [ 'apiJwt' ]], function () {
/*CRUD USER*/
Route::post('add/user/',[Users::class,'create']);
Route::post('show/user/',[Users::class,'show']);
Route::post('store/user/{id}',[Users::class,'store']);
Route::post('destroy/user/{id}',[Users::class,'destroy']);
Route::post('update/user/{id}',[Users::class,'update']);
});