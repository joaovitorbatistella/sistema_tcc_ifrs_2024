<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\TurmasController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Controller::class, 'login'])->name('controller.login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('alunos', AlunosController::class);
    Route::get('/alunos', [ProfessoresController::class, 'index'])->name('alunos-controller.index');
    Route::get('/alunos/adicionar-aluno', [ProfessoresController::class, 'create'])->name('alunos-controller.create');
    Route::post('/alunos', [ProfessoresController::class, 'store'])->name('alunos-controller.store');
    Route::get('/alunos/{professor}', [ProfessoresController::class, 'show'])->name('alunos-controller.show');
    Route::get('/alunos/{professor}/atualizar-professor', [ProfessoresController::class, 'edit'])->name('alunos-controller.edit');
    Route::put('/alunos/{professor}', [ProfessoresController::class, 'update'])->name('alunos-controller.update');
    Route::delete('/alunos/{professor}', [ProfessoresController::class, 'destroy'])->name('alunos-controller.destroy');

    // Route::resource('professores', ProfessoresController::class);
    Route::get('/professores', [ProfessoresController::class, 'index'])->name('professores-controller.index');
    Route::get('/professores/adicionar-professor', [ProfessoresController::class, 'create'])->name('professores-controller.create');
    Route::post('/professores', [ProfessoresController::class, 'store'])->name('professores-controller.store');
    Route::get('/professores/{professor}', [ProfessoresController::class, 'show'])->name('professores-controller.show');
    Route::get('/professores/{professor}/atualizar-professor', [ProfessoresController::class, 'edit'])->name('professores-controller.edit');
    Route::put('/professores/{professor}', [ProfessoresController::class, 'update'])->name('professores-controller.update');
    Route::delete('/professores/{professor}', [ProfessoresController::class, 'destroy'])->name('professores-controller.destroy');

    Route::get('/turmas', [TurmasController::class, 'index'])->name('turmas-controller.index');
    Route::get('/turmas/cadastro', [TurmasController::class, 'index']);
    Route::post('/turmas/store', [TurmasController::class, 'store'])->name('turmas.store');
    Route::post('/turmas/cadastro/step1', [TurmasController::class, 'step1']);
    Route::post('/turmas/cadastro/step2', [TurmasController::class, 'step2']);   
    Route::post('/turmas/cadastro/step3', [TurmasController::class, 'step3']);


    Route::get('/getAlunos', [AlunosController::class, 'getAlunos']); 
    
});

require __DIR__.'/auth.php';
