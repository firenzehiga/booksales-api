<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// [GET] Daftar semua pengguna
Route::get('/books', [BookController::class, 'index']);
// [GET] Daftar semua genre
Route::get('/genres',  [GenreController::class, 'index']);
// [GET] Daftar semua penulis
Route::get('/authors', [AuthorController::class, 'index']);
