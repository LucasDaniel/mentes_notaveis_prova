<?php

use App\Http\Controllers\AdressController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\UserController;
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

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

Route::get('/states', [StatesController::class, 'index']);
Route::get('/states/{id}', [StatesController::class, 'show']);

Route::get('/region', [RegionController::class, 'index']);
Route::get('/region/{id}', [RegionController::class, 'show']);

Route::get('/cities', [CitiesController::class, 'index']);
Route::get('/cities/{id}', [CitiesController::class, 'show']);

Route::get('/adress', [AdressController::class, 'index']);
Route::get('/adress/{id}', [AdressController::class, 'show']);
