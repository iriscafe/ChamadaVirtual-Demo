<?php

use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Admin\AlunoController;
use App\Http\Controllers\Api\Admin\ProfessorController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Professor\ChamadasController;
use App\Http\Controllers\Api\Professor\TurmaController;
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
Route::get('/', function () {
    return redirect()->route('home');
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('/', [AdminController::class, 'create']);
        Route::post('/professor', [ProfessorController::class, 'create']);
        Route::post('/aluno', [AlunoController::class, 'create']);
    });

    Route::prefix('professor')->group(function () {
        Route::post('/turma', [TurmaController::class, 'create']);
        Route::post('/chamada', [ChamadasController::class, 'create']);
        Route::post('/aluno/turma', [TurmaController::class, 'adicionarAlunoATurma']);
    });
});

