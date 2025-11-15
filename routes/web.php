<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LearningItemController;
use App\Http\Controllers\ExamModuleController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Learning Items
    Route::resource('learning-items', LearningItemController::class);
    Route::post('/learning-items/{learningItem}/toggle-complete', [LearningItemController::class, 'toggleComplete'])
        ->name('learning-items.toggle-complete');
    
    // Exam Modules
    Route::resource('exams', ExamModuleController::class)->parameters([
        'exams' => 'id'
    ]);
    Route::post('/exams/{id}/toggle-complete', [ExamModuleController::class, 'toggleComplete'])
        ->name('exams.toggle-complete');
    
    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [CalendarController::class, 'events'])->name('calendar.events');
    Route::put('/calendar/sessions/{session}', [CalendarController::class, 'updateSession'])
        ->name('calendar.update-session');
    
    // Statistics
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
});

