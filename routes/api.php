<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\IngresoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);
   

Route::group(['middleware'=> ['auth:sanctum']], function(){
    Route::get('user-profile',[AuthController::class, 'userProfile']);
    Route::post('logout',[AuthController::class, 'logout']);
    Route::get('ingresos',[IngresoController::class,'index']);
    Route::post('ingreso',[IngresoController::class,'store']);
    Route::get('ingreso/{id}',[IngresoController::class,'show']);
    Route::put('ingreso/{id}',[IngresoController::class,'update']);
    Route::delete('ingreso/{id}',[IngresoController::class,'destroy']);
   
});

