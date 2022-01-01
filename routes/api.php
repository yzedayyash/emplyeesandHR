<?php

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
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\UserController;

Route::post('/login', [AuthenticationController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::put('/update', [UserController::class, 'update']);


    Route::post('/sign-out', [AuthenticationController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum' , 'sanctum.abilities:hr']], function () {
    Route::get('/employees', [UserController::class, 'listEmployees']);
    Route::post('/employee', [UserController::class, 'addEmployee']);
    Route::put('/employee/{id}', [UserController::class, 'deactivateEmployee']);




});
