<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

// Redirect root to dashboard
Route::redirect('/', '/dashboard');

// Dashboard (requires login)
Route::get('/dashboard', [TaskController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Auth-protected routes
Route::middleware(['auth'])->group(function () {
    // Task routes
    Route::get('/tasks', [TaskController::class, 'index']);       // show tasks
    Route::post('/tasks', [TaskController::class, 'store']);      // add new task
    Route::patch('/tasks/{id}', [TaskController::class, 'update']); // toggle done/undo
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']); // delete task

    // Profile management (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include Breeze authentication routes (login, register, etc.)
require __DIR__.'/auth.php';
