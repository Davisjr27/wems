<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentLogbookController;
use App\Http\Controllers\StudentLogbookPDFController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    // Student logbook
    Route::get('/student/logbook/create', [StudentLogbookController::class, 'create'])
        ->name('student.logbook.create');

    Route::post('/student/logbook/store', [StudentLogbookController::class, 'store'])
        ->name('student.logbook.store');

    Route::get('/student/logbook', [StudentLogbookController::class, 'index'])
        ->name('student.logbook.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logbook/pdf', [StudentLogbookPDFController::class, 'generate'])
        ->name('student.logbook.pdf');
});

require __DIR__.'/auth.php';
