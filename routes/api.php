<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\CamaraController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CursoUserController;
use App\Http\Controllers\EmocionController;
use App\Http\Controllers\SesionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//auth routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

//api routes
Route::resource('faces', FaceController::class)->middleware('auth:api');
Route::resource('aulas', AulaController::class)->middleware('auth:api');
Route::resource('camaras',CamaraController::class)->middleware('auth:api');
Route::resource('camaras',CursoController::class)->middleware('auth:api');
Route::resource('camaras',CursoUserController::class)->middleware('auth:api');
Route::resource('camaras',EmocionController::class)->middleware('auth:api');
Route::resource('camaras',SesionController::class)->middleware('auth:api');
