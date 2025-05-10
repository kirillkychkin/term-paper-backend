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

        $query = Repository::query()        
        ->withCount([
            'tags as matching_tags_count' => function($query) use ($tags) {
                if (!empty($tags)) {
                    $query->whereIn('tags.id', $tags);
                }
            },
            'languages as matching_languages_count' => function($query) use ($languages) {
                if (!empty($languages)) {
                    $query->whereIn('languages.id', $languages);
                }
            }
        ])
        ->addSelect([
            'total_matches' => function($query) {
                $query->selectRaw('(matching_tags_count + matching_languages_count)');
            }
        ]);

        // Apply OR condition if both filters are present
        if (!empty($tags) && !empty($languages)) {
            $query->where(function($q) use ($tags, $languages) {
                $q->whereHas('tags', function($q) use ($tags) {
                    $q->whereIn('tags.id', $tags);
                })
                ->orWhereHas('languages', function($q) use ($languages) {
                    $q->whereIn('languages.id', $languages);
                });
            });
        }
        // Apply single conditions if only one filter is present
        elseif (!empty($tags)) {
            $query->whereHas('tags', function($q) use ($tags) {
                $q->whereIn('tags.id', $tags);
            });
        }
        elseif (!empty($languages)) {
            $query->whereHas('languages', function($q) use ($languages) {
                $q->whereIn('languages.id', $languages);
            });
        }
        
        // If both arrays are empty, return all repositories
        $repositories = $query->orderBy('total_matches', 'desc')->get();
        
        return response()->json(count($repositories));
    }    
}
