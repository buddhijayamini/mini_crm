<?php

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\UserController;
use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\EmployeeController;
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

Route::group([
    'middleware' => 'cors',
    'prefix' => 'v1/auth'
], function ($router) {
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::group([
    'middleware' => 'cors',
    'prefix' => 'v1'
], function ($router) {
    Route::get('/company',[CompanyController::class,'index']);
    Route::post('/company',[CompanyController::class,'store']);
    Route::get('/company/{id}',[CompanyController::class,'show']);
    Route::put('/company/{id}',[CompanyController::class,'update']);
    Route::delete('/company/{id}', [CompanyController::class, 'destroy']);

    Route::get('/employee',[EmployeeController::class,'index']);
    Route::post('/employee',[EmployeeController::class,'store']);
    Route::get('/employee/{id}',[EmployeeController::class,'show']);
    Route::put('/employee/{id}',[EmployeeController::class,'update']);
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);
});

Route::fallback(function(){
    return response()->json(['message' => 'Resource not found.'], 404);
});
