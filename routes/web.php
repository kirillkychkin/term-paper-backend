<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TagCategoryController;

Route::get('/languages', [LanguageController::class, 'getAll']);
Route::get('/languages/{id}', [LanguageController::class, 'getOne']);

Route::get('/tag-categories', [TagCategoryController::class, 'getAll']);
Route::get('/tag-categories/{id}', [TagCategoryController::class, 'getOne']);
Route::get('/tag-categories/{id}/tags', [TagCategoryController::class, 'getTags']);

