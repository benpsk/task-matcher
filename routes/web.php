<?php

use App\Http\Controllers\AssignTaskController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TechnicianController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', HomeController::class)->name('home');

Route::resource('tasks', TaskController::class)->only('create', 'store');
Route::resource('technicians', TechnicianController::class)->only('create', 'store');
Route::post('/assign-task', AssignTaskController::class)->name('assign.task');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
