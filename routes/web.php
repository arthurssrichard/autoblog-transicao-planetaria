<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TTSController;
use App\Http\Controllers\CategoryController;

Route::get('/categories/create',[CategoryController::class,'create']);

Route::get('/', [HomeController::class, 'index']);

Route::get('/posts/create',[PostController::class, 'create']);
Route::get('/posts/{slug}',[PostController::class, 'show']);
Route::get('/posts',[PostController::class,'index']);

Route::post('/posts/auto-create',[PostController::class,'autoCreate']);
Route::post('/posts',[PostController::class, 'store']);
Route::post('/tts/synthesize', [TTSController::class, 'synthesize']);


Route::get('/books/create',[BookController::class, 'create']);
Route::post('/books',[BookController::class, 'store']);
Route::get('/books/{id}',[BookController::class, 'show']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
