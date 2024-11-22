<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\CamaraController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CursoUserController;
use App\Http\Controllers\EmocionController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\MenuUserController;
use App\Http\Controllers\UserController;

//auth routes
Route::group(
    [
        "middleware" => "api",
        "prefix" => "auth",
    ],
    function ($router) {
        Route::post("/register", [AuthController::class, "register"])->name(
            "register"
        );
        Route::post("/login", [AuthController::class, "login"])->name("login");
        Route::post("/logout", [AuthController::class, "logout"])
            ->middleware("auth:api")
            ->name("logout");
        Route::post("/refresh", [AuthController::class, "refresh"])
            ->middleware("auth:api")
            ->name("refresh");
        Route::post("/me", [AuthController::class, "me"])
            ->middleware("auth:api")
            ->name("me");
    }
);

//api routes
Route::resource("usuarios", UserController::class)->middleware("auth:api");
Route::get("docentes_combo", [UserController::class, 'docentes_combo'])->middleware("auth:api");

Route::resource("faces", FaceController::class)->middleware("auth:api");
Route::resource("aulas", AulaController::class)->middleware("auth:api");
Route::get('aulas_combo', [AulaController::class, 'aulas_combo'])->middleware("auth:api");
Route::resource("camaras", CamaraController::class)->middleware("auth:api");
Route::resource("cursos", CursoController::class)->middleware("auth:api");
Route::get("cursos_combo", [CursoController::class, 'cursos_combo'])->middleware("auth:api");
Route::resource("cursousers", CursoUserController::class)->middleware(
    "auth:api"
);
Route::resource("emociones", EmocionController::class)->middleware("auth:api");

Route::resource("sesiones", SesionController::class)->middleware("auth:api");
Route::get("sessions_by_aulas_id", [SesionController::class, 'sessions_by_aulas_id' ])->middleware("auth:api");

Route::resource("menuusers", MenuUserController::class)->middleware("auth:api");
