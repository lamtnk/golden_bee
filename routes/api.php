<?php

use App\Http\Controllers\PartnerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionQueueController;
use App\Http\Controllers\StartController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('questions', QuestionController::class);

Route::apiResource('question-queues', QuestionQueueController::class);

Route::apiResource('partners', PartnerController::class);

Route::apiResource('starts', StartController::class);

Route::patch('questions/{id}/activate', [QuestionController::class, 'updateActivate']);

// Route::prefix('questions')->group(function () {
//     Route::get('/', [QuestionController::class, 'index']);
//     Route::get('/{id}', [QuestionController::class, 'show']);
//     Route::post('', [QuestionController::class, 'store']);
//     Route::post('/{id}/update', [QuestionController::class, 'update']);
//     Route::post('/{id}/destroy', [QuestionController::class, 'destroy']);
// });

