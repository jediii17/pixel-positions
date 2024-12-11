<?php

use App\Http\Controllers\ApplyJobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [JobController::class, 'index'])->name('home');

// Employer
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/view-applicants', [JobController::class, 'show'])->middleware('auth')->name('jobs.view-applicants');
Route::get('/jobs/{job}/applicants', [JobController::class, 'showApplicants'])->name('jobs.applicants')->middleware('auth');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->middleware('auth');


// Member
Route::get('/jobs/applied', [JobApplicationController::class, 'show'])
    ->middleware('auth');
Route::patch('/job-applications/{application}/status', [JobApplicationController::class, 'updateStatus'])
    ->middleware('auth')->name('job-applications.status');
Route::get('/apply/{job}', [JobApplicationController::class, 'create'])
    ->middleware('auth')
    ->can('apply', 'job')
    ->name('apply-jobs');
Route::post('/apply/{job}/application', [JobApplicationController::class, 'store'])->middleware('auth');

// All
Route::get('/search', SearchController::class);
Route::get('/tags/{tag:name}', TagController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
