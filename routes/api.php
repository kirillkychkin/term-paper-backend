<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TagCategoryController;
use App\Http\Controllers\RepositoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/languages', [LanguageController::class, 'getAll']);
Route::get('/languages/{id}', [LanguageController::class, 'getOne']);

Route::get('/tag-categories', [TagCategoryController::class, 'getAll']);
Route::get('/tag-categories/{id}', [TagCategoryController::class, 'getOne']);
Route::get('/tag-categories/{id}/tags', [TagCategoryController::class, 'getTags']);

Route::post('/repositories/search', [RepositoryController::class, 'search']);
Route::get('/repositories/{id}', [RepositoryController::class, 'getOne']);