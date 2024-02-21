<?php

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

Route::apiResource('absent',\App\Http\Controllers\Api\AbsentController::class);
Route::post('/absent/add',[\App\Http\Controllers\Api\AbsentController::class,'store'])->name('absent.store');
Route::get('/absent-detail/{eid}',[\App\Http\Controllers\Api\AbsentController::class,'index']);
Route::get('/workday/{year}',
    [\App\Http\Controllers\Api\AbsentController::class,'summary']
);
Route::get('/employee',
    [\App\Http\Controllers\Api\AbsentController::class,'getEmp']
);
Route::get('/dashboard',
    [\App\Http\Controllers\Api\AbsentController::class,'getDashBoard']
);
