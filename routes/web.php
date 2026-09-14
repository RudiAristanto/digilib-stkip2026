<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PdfViewerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserDocumentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| PUBLIC DOCUMENTS
|--------------------------------------------------------------------------
*/

Route::get('/documents', [DocumentController::class, 'index'])
    ->name('documents.index');

Route::get('/documents/{document}', [DocumentController::class, 'show'])
    ->name('documents.show');

/*
|--------------------------------------------------------------------------
| PUBLIC KATEGORI DAN AUTHOR
|--------------------------------------------------------------------------
*/

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/categories/{category}', [CategoryController::class, 'show'])
    ->name('categories.show');


// Route::get('/authors', [AuthorController::class, 'index'])
//     ->name('authors.index');

// Route::get('/authors/{author}', [AuthorController::class, 'show'])
//     ->name('authors.show');


Route::view('/about', 'about')
    ->name('about');

/*
|--------------------------------------------------------------------------
| PDF VIEWER
|--------------------------------------------------------------------------
*/

Route::get('/viewer/{document}', [PdfViewerController::class, 'show'])
    ->name('pdf.viewer');

Route::get('/viewer/{document}/stream', [PdfViewerController::class, 'stream'])
    ->name('documents.stream');

Route::get('/documents/{document}/download', [PdfViewerController::class, 'download'])
    ->name('documents.download');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | USER DOCUMENTS
    |--------------------------------------------------------------------------
    */

    Route::get('/my-documents/create', [UserDocumentController::class, 'create'])
        ->name('user.documents.create');

    Route::post('/my-documents', [UserDocumentController::class, 'store'])
        ->name('user.documents.store');


    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    
    /*
    |--------------------------------------------------------------------------
    | MY DOCUMENTS
    |--------------------------------------------------------------------------
    */

    Route::get('/my-documents', [UserDocumentController::class, 'index'])
    ->name('user.documents.index');

    Route::get('/my-documents/create', [UserDocumentController::class, 'create'])
        ->name('user.documents.create');

    Route::post('/my-documents', [UserDocumentController::class, 'store'])
        ->name('user.documents.store');

    Route::get(
        '/my-documents/{document}/edit',
        [UserDocumentController::class, 'edit']
    )->name('user.documents.edit');

    Route::put(
        '/my-documents/{document}',
        [UserDocumentController::class, 'update']
    )->name('user.documents.update');

    Route::get('/my-downloads', [UserDashboardController::class, 'downloads'])
    ->name('user.downloads');

});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';