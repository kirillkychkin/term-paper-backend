<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    public function getAll()
    {
        $languages = Language::all();
 
        return response()
            ->json($languages);
    }    

    public function getOne(string $languageId)
    {
        $language = Language::where('id', $languageId)->first();
 
        return response()
            ->json($language);
    }
}
