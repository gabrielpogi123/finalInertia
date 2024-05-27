<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/documents', function () {
    return Inertia::render('Document');
})->middleware(['auth', 'verified'])->name('documents');

// Route to show the form for creating a new document
Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');

// Route to store a newly created document in storage
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');

// Route to display the specified document
Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');

// Route to show the form for editing the specified document
Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');

// Route to update the specified document in storage
Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('documents.update');

// Route to remove the specified document from storage
Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
