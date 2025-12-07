<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLogbookController;
use App\Http\Controllers\StudentLogbookPDFController;
use App\Http\Controllers\LogbookController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('student.dashboard');
})->middleware(['auth'])->name('dashboard');


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

    Route::get('/student/logbook/pdf', [StudentLogbookPDFController::class, 'generate'])
        ->name('student.logbook.pdf');

    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])
        ->name('student.dashboard');

    Route::post('/student/passport/update', [StudentController::class, 'updatePassport'])
        ->name('student.passport.update');


});

Route::middleware(['auth'])->group(function () {
    Route::get('/student/logbook', [LogbookController::class, 'index'])->name('student.logbook.index');
    Route::get('/student/logbook/create', [LogbookController::class, 'create'])->name('student.logbook.create');
    Route::post('/student/logbook', [LogbookController::class, 'store'])->name('student.logbook.store');
    Route::get('/student/logbook/{id}/download', [LogbookController::class, 'download'])->name('student.logbook.download');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])
        ->name('student.dashboard');

    Route::get('/student/profile', [StudentController::class, 'profile'])
        ->name('student.profile');

    Route::post('/student/passport/update', [StudentController::class, 'updatePassport'])
        ->name('student.passport.update');

});



require __DIR__.'/auth.php';
