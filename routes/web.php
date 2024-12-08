<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/posts/create',[PostController::class, 'create']);
Route::post('/posts',[PostController::class, 'store']);


Route::get('/books/create',[BookController::class, 'create']);
Route::post('/books',[BookController::class, 'store']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
