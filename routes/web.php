<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TTSController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;

/* ADMIN ROUTES */
Route::middleware(['is_admin'])->group(function (){
    Route::redirect('/blogadmin','/blogadmin/posts');

    // Categories routes
    Route::get('/blogadmin/categories',[CategoryController::class,'index']);
    Route::get('/blogadmin/categories/create',[CategoryController::class,'create']);
    Route::get('/blogadmin/categories/{id}/edit',[CategoryController::class,'edit']);

    // Posts routes
    Route::get('/blogadmin/posts',[PostController::class,'indexAdmin']);
    Route::get('/blogadmin/posts/create',[PostController::class, 'create']);
    Route::get('/blogadmin/posts/{id}/edit',[PostController::class, 'edit']);
    Route::post('/blogadmin/posts/auto-create',[PostController::class,'autoCreate']);
    Route::post('/blogadmin/posts/specific-auto-create',[PostController::class,'specificAutoCreate']);
    Route::post('/blogadmin/posts',[PostController::class, 'store']);

    // Books routes
    Route::get('/blogadmin/books',[BookController::class, 'index']);
    Route::get('/blogadmin/books/create',[BookController::class, 'create']);
    Route::post('/blogadmin/books',[BookController::class, 'store']);
    Route::get('/blogadmin/books/{id}',[BookController::class, 'show']);
    Route::delete('/blogadmin/books/{id}',[BookController::class, 'destroy']);

    Route::get('/blogadmin/settings',function(){
        return view('admin.settings');
    });
});

/* PUBLIC ROUTES */
// Post routes
Route::get('/posts/{slug}',[PostController::class, 'show']);
Route::get('/posts',[PostController::class,'index']);

// General routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/sobre-nos', [HomeController::class, 'sobreNos']);
Route::get('/contato', [HomeController::class, 'contato']);
Route::get('/introducao', [HomeController::class, 'introducao']);
Route::get('/politica-de-privacidade', [HomeController::class, 'politicaDePrivacidade']);
Route::get('/termos-de-uso', [HomeController::class, 'termos-de-uso']);



Route::post('/tts/synthesize', [TTSController::class, 'synthesize']);

Route::get('/optimized-image/{filename}',[ImageController::class, 'optimizedImage']);

Route::get('/sitemap.xml', function () {
    $posts = \App\Models\Post::latest()->get();
    return response()->view('sitemap', compact('posts'))->header('Content-Type', 'text/xml');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});
