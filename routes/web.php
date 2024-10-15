<?php

use App\Http\Controllers\admin\QuestionController;
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


Route::prefix('/question')->group(function () {
    Route::get('/', [QuestionController::class, 'index'])->name('admin.question.index');
    Route::get('/add', [QuestionController::class, 'showAddQuestion'])->name('admin.question.show_add');
    Route::post('/add', [QuestionController::class, 'addQuestion'])->name('admin.question.add');
    Route::post('/edit', [QuestionController::class, 'editQuestion'])->name('admin.question.edit');
    Route::get('/edit/{id}', [QuestionController::class, 'showEditQuestion'])->name('admin.question.show_edit');
    Route::get('/delete', [QuestionController::class, 'deleteQuestion'])->name('admin.question.delete');
});