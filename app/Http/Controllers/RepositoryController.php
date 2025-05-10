<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repository;
use App\Models\Language;
use App\Models\Tag;

class RepositoryController extends Controller
{
    public function search(Request $request)
    {
        $tags = $request->input('tags');
        $languages = $request->input('languages');

        $query = Repository::query();
        
        // If tags are provided, filter repositories that have at least one matching tag
        if (!empty($tags)) {
            $query->whereHas('tags', function($q) use ($tags) {
                $q->whereIn('tags.id', $tags);
            });
        }
        
        // If languages are provided, filter repositories that have at least one matching language
        if (!empty($languages)) {
            $query->whereHas('languages', function($q) use ($languages) {
                $q->whereIn('languages.id', $languages);
            });
        }
        
        // If both arrays are empty, return all repositories
        $repositories = $query->get();
        
        return response()->json($repositories);
    }    
}
