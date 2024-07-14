<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\ClassController;
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
    Route::post('/verificar-rg', [AlunosController::class, 'verificarRG'])->name('verificar.rg');
    Route::post('/verificar-cpf', [AlunosController::class, 'verificarCPF'])->name('verificar.cpf');
    Route::post('/verificar-email', [AlunosController::class, 'verificarEmail'])->name('verificar.email');
    Route::get('/alunos', [AlunosController::class, 'index'])->name('alunos-controller.index');
    Route::get('/alunos/adicionar-aluno', [AlunosController::class, 'create'])->name('alunos-controller.create');
    Route::post('/alunos', [AlunosController::class, 'store'])->name('alunos-controller.store');
    Route::get('/alunos/{aluno}', [AlunosController::class, 'show'])->name('alunos-controller.show');
    Route::get('/alunos/{aluno}/atualizar-aluno', [AlunosController::class, 'edit'])->name('alunos-controller.edit');
    Route::put('/alunos/{aluno}', [AlunosController::class, 'update'])->name('alunos-controller.update');
    Route::delete('/alunos/{aluno}', [AlunosController::class, 'destroy'])->name('alunos-controller.destroy');

    // Route::resource('professores', ProfessoresController::class);
    Route::post('/verificar-rg', [ProfessoresController::class, 'verificarRG'])->name('verificar.rg');
    Route::post('/verificar-cpf', [ProfessoresController::class, 'verificarCPF'])->name('verificar.cpf');
    Route::post('/verificar-email', [ProfessoresController::class, 'verificarEmail'])->name('verificar.email');
    Route::get('/professores', [ProfessoresController::class, 'index'])->name('professores-controller.index');
    Route::get('/professores/adicionar-professor', [ProfessoresController::class, 'create'])->name('professores-controller.create');
    Route::post('/professores', [ProfessoresController::class, 'store'])->name('professores-controller.store');
    Route::get('/professores/{professor}', [ProfessoresController::class, 'show'])->name('professores-controller.show');
    Route::get('/professores/{professor}/atualizar-professor', [ProfessoresController::class, 'edit'])->name('professores-controller.edit');
    Route::put('/professores/{professor}', [ProfessoresController::class, 'update'])->name('professores-controller.update');
    Route::delete('/professores/{professor}', [ProfessoresController::class, 'destroy'])->name('professores-controller.destroy');

    Route::get('/classes', [ClassController::class, 'index'])->name('class-controller.index');
    Route::post('/classes/create', [ClassController::class, 'store'])->name('class-controller.store');
});

require __DIR__.'/auth.php';
