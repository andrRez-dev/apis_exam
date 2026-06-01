<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ArticleController;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('authors', AuthorController::class)->only('index');
Route::resource('articles', ArticleController::class)->only('index');

Route::middleware('auth')->group(function () { 
    Route::resource('authors', AuthorController::class)->except('index');
    Route::resource('articles', ArticleController::class)->except('index');
});
