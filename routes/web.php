<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuizController;
use App\Models\Question;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' =>['auth']], function(){
    Route::get('/dashboard','App\Http\Controllers\AdminController@index')->name('dashboard');
    Route::get('/add-question','App\Http\Controllers\AdminController@addQuestion')->name('add-question');
    Route::get('/add','App\Http\Controllers\AdminController@add')->name('add');
    Route::get('/perform-quiz','App\Http\Controllers\QuizController@loadQuiz')->name('perform-quiz');
    Route::post('/result','App\Http\Controllers\QuizController@evaluateQuiz')->name('evaluate');
    Route::post('/add','App\Http\Controllers\AdminController@addQA')->name('add');
    Route::post('/delete','App\Http\Controllers\AdminController@delete')->name('delete');
    Route::get('/game-world','App\Http\Controllers\GameController@check')->name('game-world');
    Route::get('/dashboard/progress','App\Http\Controllers\GameController@checkProgress')->name('progress');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
