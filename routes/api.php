<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\AulaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('faces', FaceController::class);

Route::resource('aulas', AulaController::class);
