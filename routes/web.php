<?php

use App\Http\Controllers\Web\Aluno\Turma\TurmasController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\Professor\ChamadaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Aluno\Chamada\ChamadaController as AlunoChamadaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

//PROFESSOR
Route::get('/chamadas/create', [ChamadaController::class, 'create'])->name('chamadas.create');
Route::post('/chamadas/store', [ChamadaController::class, 'store'])->name('chamadas.store');

Route::get('/chamadas', [ChamadaController::class, 'index'])->name('chamadas.index');
Route::get('/chamadas/{chamada_id}', [ChamadaController::class, 'show'])->name('chamadas.show');


//ALUNO
Route::prefix('aluno')->group(function () {
    Route::get('turmas', [TurmasController::class, 'index'])->name('alunos.turma.index');
    Route::get('chamada/turma/{turmaId}', [AlunoChamadaController::class, 'showMarkPresent'])->name('alunos.turma.show');
    Route::get('chamada/{turmaId}/markPresentView', [AlunoChamadaController::class, 'markPresentView'])->name('alunos.turma.chamda.mark-present-view');
    Route::post('chamada/{turmaId}/markPresent', [AlunoChamadaController::class, 'markPresent'])->name('alunos.turma.chamada.mark-present');

});
