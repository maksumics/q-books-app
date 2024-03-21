<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'check'])->name('login');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(CheckAuth::class)->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('authors/list/{page?}', [AuthorsController::class, 'index'])->name('authors-list');
    Route::get('authors/{id}', [AuthorsController::class, 'get'])->name('author-detail');
    Route::get('authors/delete/{id}', [AuthorsController::class, 'delete'])->name('author-delete');

    Route::get('books/create', [BookController::class, 'create'])->name('book-create');
    Route::post('books/store', [BookController::class, 'store'])->name('book-store');
    Route::get('books/delete/{id}', [BookController::class, 'delete'])->name('book-delete');
});


