<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompletedFormsController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormThemeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PostWorkAnswerController;
use App\Http\Controllers\PostWorkController;
use App\Http\Controllers\QuestionController;
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

Route::middleware('auth:sanctum')->get(
    '/user',

    function (Request $request) {
        return $request->user();
    }
);
Route::post('login', [AuthController::class, 'login']);
Route::post('add/user/', [Users::class, 'create']);

Route::group(['middleware' => ['apiJwt']], function () {

    /*CRUD USER*/
    Route::post('show/user/', [Users::class, 'show']);
    Route::post('store/user/{id}', [Users::class, 'store']);
    Route::post('destroy/user/{id}', [Users::class, 'destroy']);
    Route::post('update/user/{id}', [Users::class, 'update']);
    Route::post('update/status/{id}', [Users::class, 'updateStatus']);

    /*CRUD COMPLETED FORM ADM*/
    Route::post('store/CompForm/{id}', [CompletedFormsController::class, 'store']);
    Route::post('show/CompForm/{id}', [CompletedFormsController::class, 'show']);
    Route::post('perDate/CompForm/{id}', [CompletedFormsController::class, 'perDate']);
    Route::post('perSector/CompForm/{id}', [CompletedFormsController::class, 'perSector']);

    /*CRUD COMPLETED FORM USER*/
    Route::post('storeUser/CompForm/{id}', [CompletedFormsController::class, 'storeUser']);
    Route::post('answer/CompForm/{id}', [CompletedFormsController::class, 'showUser']);
    Route::post('answer/all', [CompletedFormsController::class, 'allAnswer']);
    Route::post('perDateUser/CompForm/{id}', [CompletedFormsController::class, 'perDateUser']);
    Route::post('perSectorUser/CompForm/{id}', [CompletedFormsController::class, 'perSectorUser']);
    Route::post('filter/CompForm', [CompletedFormsController::class, 'filter']);
    Route::post('postWorkBySector/CompForm', [CompletedFormsController::class, 'postWorkBySector']);

    /*CRUD POST WORK INFOS*/
    Route::post('add/InformationForForms', [PostWorkController::class, 'create']);
    Route::post('show/InformationForForms', [PostWorkController::class, 'show']);
    Route::post('store/InformationForForms/{id}', [PostWorkController::class, 'store']);
    Route::post('destroy/InformationForForms/{id}', [PostWorkController::class, 'destroy']);
    Route::post('update/InformationForForms/{id}', [PostWorkController::class, 'update']);

    /*CRUD POST WORK ANSWERS*/
    Route::post('show/AnswerForForms', [PostWorkAnswerController::class, 'show']);
    Route::post('store/AnswerForForms/{id}', [PostWorkAnswerController::class, 'store']);
    Route::post('destroy/AnswerForForms/{id}', [PostWorkAnswerController::class, 'destroy']);
    Route::post('update/AnswerForForms/{id}', [PostWorkAnswerController::class, 'update']);
    Route::post('sendFile64', [PostWorkAnswerController::class, 'image64']);
    
    /*CRUD FORMS*/
    Route::post('add/form/', [FormController::class, 'create']);
    Route::post('show/form/', [FormController::class, 'show']);
    Route::post('store/form/{id}', [FormController::class, 'store']);
    Route::post('destroy/form/{id}', [FormController::class, 'destroy']);
    Route::post('update/form/{id}', [FormController::class, 'update']);
    
    /*CRUD FORMTHEME*/
    Route::post('add/formTheme/', [FormThemeController::class, 'create']);
    Route::post('show/formTheme/', [FormThemeController::class, 'show']);
    Route::post('store/formTheme/{id}', [FormThemeController::class, 'store']);
    Route::post('destroy/formTheme/{id}', [FormThemeController::class, 'destroy']);
    Route::post('update/formTheme/{id}', [FormThemeController::class, 'update']);
    
    /*CRUD ANSWER*/
    Route::post('add/answer/', [AnswerController::class, 'create']);
    Route::post('show/answer/', [AnswerController::class, 'show']);
    Route::post('store/answer/{id}', [AnswerController::class, 'store']);
    Route::post('destroy/answer/{id}', [AnswerController::class, 'destroy']);
    Route::post('update/answer/{id}', [AnswerController::class, 'update']);
    
    /*CRUD QUESTION*/
    Route::post('add/question/', [QuestionController::class, 'create']);
    Route::post('show/question/', [QuestionController::class, 'show']);
    Route::post('store/question/{id}', [QuestionController::class, 'store']);
    Route::post('destroy/question/{id}', [QuestionController::class, 'destroy']);
    Route::post('update/question/{id}', [QuestionController::class, 'update']);
    
    /*CRUD SECTOR*/
    Route::post('add/sector/', [SectorController::class, 'create']);
    Route::post('store/sector/{id}', [SectorController::class, 'store']);
    Route::post('destroy/sector/{id}', [SectorController::class, 'destroy']);
    Route::post('update/sector/{id}', [SectorController::class, 'update']);
});

Route::post('show/sector/', [SectorController::class, 'show']);
Route::post('changePass/user/{id}', [Users::class, 'changePass']);
Route::post('changeSignature/user/{id}', [Users::class, 'changeSignature']);

Route::get('postWorkAnswer/export/{id}', [PostWorkAnswerController::class, 'export']);
Route::get('pdf/{id}', [PdfController::class, 'index']);
Route::post('pdf64/{id}', [PdfController::class, 'indexBase64']);


Route::post('add/AnswerForForms', [PostWorkAnswerController::class, 'create']);