<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\CamaraController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CursoUserController;
use App\Http\Controllers\EmocionController;
use App\Http\Controllers\SesionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('faces', FaceController::class);
Route::resource('aulas', AulaController::class);
Route::resource('camaras',CamaraController::class);
Route::resource('camaras',CursoController::class);
Route::resource('camaras',CursoUserController::class);
Route::resource('camaras',EmocionController::class);
Route::resource('camaras',SesionController::class);
