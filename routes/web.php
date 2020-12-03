<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\QuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::middleware(['admin'])->group(function () {
        Route::resource('question', QuestionController::class);
        Route::resource('question.answers', QuestionAnswerController::class);
    });

    Route::get('/start-game', [GameController::class, 'startGame'])->name('start_game');
    Route::get('/game/{game_id}/question/{question_id}', [GameController::class, 'playGame'])->name('play_game');
    Route::post('/check-question', [GameController::class, 'checkQuestion'])->name('check_question');

});
