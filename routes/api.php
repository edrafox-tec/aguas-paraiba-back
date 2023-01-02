<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SectorController;
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
Route::post('add/user/',[Users::class,'create']);

Route::group(['middleware' => [ 'apiJwt' ]], function () {
/*CRUD USER*/

Route::post('show/user/',[Users::class,'show']);
Route::post('store/user/{id}',[Users::class,'store']);
Route::post('destroy/user/{id}',[Users::class,'destroy']);
Route::post('update/user/{id}',[Users::class,'update']);

/*CRUD SECTOR*/
Route::post('add/sector/',[SectorController::class,'create']);
Route::post('show/sector/',[SectorController::class,'show']);
Route::post('store/sector/{id}',[SectorController::class,'store']);
Route::post('destroy/sector/{id}',[SectorController::class,'destroy']);
Route::post('update/sector/{id}',[SectorController::class,'update']);
});