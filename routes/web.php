<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\TurmasController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ActivityController;
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
    Route::get('/user-params', [ProfileController::class, 'userParams'])->name('profile.user-params');


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

    Route::group(['prefix' => 'api'], function () {
        Route::get('/alunos/list', [AlunosController::class, 'list'])->name('alunos-controller-list');
        Route::get('/templates/list', [TemplateController::class, 'list'])->name('template-controller-list');
    });

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

    Route::get('/turmas', [TurmasController::class, 'index'])->name('turmas-controller.index');
    Route::post('/turmas/cadastro/step1', [TurmasController::class, 'step1']);
    Route::post('/turmas/cadastro/step2', [TurmasController::class, 'step2']);
    Route::post('/turmas/cadastro/step3', [TurmasController::class, 'step3']);

    Route::get('/classes', [ActivityController::class, 'index'])->name('class-controller.index');
    Route::get('/classes/new', [ClassController::class, 'index'])->name('class-controller-new.index');
    Route::post('/classes/create', [ClassController::class, 'store'])->name('class-controller.store');

    Route::get('/biblioteca', function () {
        return view('biblioteca');
    })->middleware(['auth', 'verified'])->name('biblioteca');

    Route::get('/arquivos', function () {
        return view('arquivos');
    })->middleware(['auth', 'verified'])->name('arquivos');

    Route::get('/files/list', [FileController::class, 'listFiles'])->name('files.list');
    Route::post('/upload/file', [FileController::class, 'uploadFile'])->name('upload.file');
    Route::delete('/files/delete/{id}', [FileController::class, 'deleteFile'])->name('files.delete');
    Route::get('/download/{fileId}', [FileController::class, 'download']);
    Route::get('/search', [FileController::class, 'search'])->name('files.search');
    Route::get('/search-public', [FileController::class, 'searchPublic'])->name('files.search-public');
    Route::get('/recent-files', [FileController::class, 'recentFiles'])->name('recent.files');

    Route::get('/classes/{class_id}/activities', [ActivityController::class, 'index'])->name('activity-controller.index');
    Route::get('/atividades/{id}', [ActivityController::class, 'show'])->name('activity-controller.show');
    Route::post('/atividades/{id}/advance', [ActivityController::class, 'advance'])->name('activities.advance');
    Route::post('/atividades/{id}/return', [ActivityController::class, 'return'])->name('activities.return');
});

require __DIR__ . '/auth.php';
