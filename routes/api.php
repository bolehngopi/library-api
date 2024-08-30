<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PublisherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
});

Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::post('/', [BookController::class, 'store'])->name('store');
    Route::get('/{book}', [BookController::class, 'show'])->name('show');
    Route::put('/{book}', [BookController::class, 'update'])->name('update');
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
    Route::get('/search', [BookController::class, 'search'])->name('search');
});

Route::prefix('authors')->name('authors.')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('index');
    Route::post('/', [AuthorController::class, 'store'])->name('store');
    Route::get('/{author}', [AuthorController::class, 'show'])->name('show');
    Route::put('/{author}', [AuthorController::class, 'update'])->name('update');
    Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('destroy');
});

Route::prefix('genres')->name('genres.')->group(function () {
    Route::get('/', [GenreController::class, 'index'])->name('index');
    Route::post('/', [GenreController::class, 'store'])->name('store');
    Route::get('/{genre}', [GenreController::class, 'show'])->name('show');
    Route::put('/{genre}', [GenreController::class, 'update'])->name('update');
    Route::delete('/{genre}', [GenreController::class, 'destroy'])->name('destroy');
});

Route::prefix('publishers')->name('publishers.')->group(function () {
    Route::get('/', [PublisherController::class, 'index'])->name('index');
    Route::post('/', [PublisherController::class, 'store'])->name('store');
    Route::get('/{publisher}', [PublisherController::class, 'show'])->name('show');
    Route::put('/{publisher}', [PublisherController::class, 'update'])->name('update');
    Route::delete('/{publisher}', [PublisherController::class, 'destroy'])->name('destroy');
});
