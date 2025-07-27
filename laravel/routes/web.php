<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::resource('tasks', TaskController::class);

    Route::post('/tasks/{task}/generate-link', [TaskController::class, 'generatePublicLink'])
        ->name('tasks.generatePublicLink');
});

Route::get('/tasks/{task}/public/{token}', [TaskController::class, 'showPublic'])
    ->name('tasks.public.show');

Route::get('/tasks/{task}/history', [TaskController::class, 'history'])->name('tasks.history');

Route::get('/test-mail', function () {
    $task = \App\Models\Task::first();
    if (!$task) {
        return 'Brak zadań do testu.';
    }

    \Illuminate\Support\Facades\Mail::to('twoj-email@domena.com')->send(new \App\Mail\TaskDueTomorrow($task));

    return 'Mail wysłany (sprawdź logi lub inbox)';
});

require __DIR__.'/auth.php';
