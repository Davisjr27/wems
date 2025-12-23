<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLogbookPDFController;
use App\Http\Controllers\Student\SubmissionController;
use App\Http\Controllers\Officer\SubmissionReviewController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// student routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])
        ->name('student.dashboard');

    Route::get('/student/profile', [StudentController::class, 'profile'])
        ->name('student.profile');

    Route::post('/student/passport/update', [StudentController::class, 'updatePassport'])
        ->name('student.passport.update');

    // student logbook PDF generation

    Route::get('/student/logbook/pdf', [StudentLogbookPDFController::class, 'generate'])
        ->name('student.logbook.pdf');

    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])
        ->name('student.dashboard');

    Route::post('/student/passport/update', [StudentController::class, 'updatePassport'])
        ->name('student.passport.update');

    // student logbook routes
    Route::get('/student/logbook', [LogbookController::class, 'index'])->name('student.logbook.index');
    Route::get('/student/logbook/create', [LogbookController::class, 'create'])->name('student.logbook.create');
    Route::post('/student/logbook', [LogbookController::class, 'store'])->name('student.logbook.store');
    Route::get('/student/logbook/{id}/download', [LogbookController::class, 'download'])->name('student.logbook.download');

    // student submission routes
    Route::get('submission/create', [SubmissionController::class,'create'])->name('student.submission.create');
    Route::post('submission', [SubmissionController::class,'store'])->name('student.submission.store');
    Route::get('submission', [SubmissionController::class,'index'])->name('student.submission.index');

});

// officer routes
Route::middleware(['auth', 'role:officer'])->group(function () {
    Route::get('/officer/dashboard', [OfficerController::class, 'dashboard'])
        ->name('officer.dashboard');
    Route::get('/officer/profile', [OfficerController::class, 'profile'])
        ->name('officer.profile');

    // officer submission review routes
    Route::get('submissions', [SubmissionReviewController::class,'index'])->name('submission.index');
    Route::get('submissions/{id}', [SubmissionReviewController::class,'show'])->name('submission.show');
    Route::post('submissions/{id}/approve', [SubmissionReviewController::class,'approve'])->name('submission.approve');
    Route::post('submissions/{id}/reject', [SubmissionReviewController::class,'reject'])->name('submission.reject');
    Route::get('submissions/{id}/download', [SubmissionReviewController::class,'download'])->name('submission.download');

    Route::get('/officer/student/{student}', [OfficerController::class, 'viewStudentLogbook'])
    ->name('officer.student.view');

});

// admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Route::middleware(['officer'])->group(function () {

//     Route::get('/officer/student/{studentId}/logbook', [OfficerController::class, 'viewStudentLogbook'])->name('officer.student.logbook.view');
//     Route::get('/officer/student/{studentId}/final-summary/preview', [OfficerController::class, 'previewFinalSummary'])->name('officer.student.final-summary.preview');
//     Route::post('/officer/student/{id}/summary/approve', [OfficerController::class, 'approveSummary'])->name('officer.approve.summary');
//     Route::post('/officer/student/{id}/summary/reject', [OfficerController::class, 'rejectSummary'])->name('officer.reject.summary');


// });


require __DIR__.'/auth.php';
