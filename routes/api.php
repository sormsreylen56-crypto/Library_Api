<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookTypeController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BookAuthorController;

Route::apiResource('authors', AuthorController::class);
Route::apiResource('book-types', BookTypeController::class);
Route::apiResource('books', BookController::class);

// BookAuthor ប្រើ composite key
Route::get('book-authors', [BookAuthorController::class, 'index']);
Route::post('book-authors', [BookAuthorController::class, 'store']);
Route::get('book-authors/{bookId}/{authorId}', [BookAuthorController::class, 'show']);
Route::put('book-authors/{bookId}/{authorId}', [BookAuthorController::class, 'update']);
Route::delete('book-authors/{bookId}/{authorId}', [BookAuthorController::class, 'destroy']);