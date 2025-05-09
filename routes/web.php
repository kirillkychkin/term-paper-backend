<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

Route::get('/languages', [LanguageController::class, 'getAll']);
Route::get('/languages/{id}', [LanguageController::class, 'getOne']);