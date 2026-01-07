<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/books', [\App\Http\Controllers\Api\BookController::class, 'index']);
Route::get('/books/{id}', [\App\Http\Controllers\Api\BookController::class, 'show']);
Route::get('/categories', [\App\Http\Controllers\Api\CategoryController::class, 'index']);

// Serve public disk files through the API so browsers (Flutter Web) receive CORS headers.
Route::get('/images/{path}', function (string $path) {
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $response = Storage::disk('public')->response($path);
    $response->headers->set('Access-Control-Allow-Origin', '*');
    return $response;
})->where('path', '.*');

