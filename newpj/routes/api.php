<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('post',\App\Http\Controllers\Api\EmpController::class);
Route::middleware('validate_token')->group(function (){
    Route::post('register',[\App\Http\Controllers\Api\EmpController::class,'register']);
    Route::post('login',[\App\Http\Controllers\Api\EmpController::class,'login']);
    Route::post('post/create',[\App\Http\Controllers\Api\EmpController::class,'createPost']);
    Route::put('post/update',[\App\Http\Controllers\Api\EmpController::class,'index']);
    Route::get('post/{uid}',[\App\Http\Controllers\Api\EmpController::class,'getList']);
});
