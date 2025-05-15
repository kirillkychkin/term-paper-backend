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
        $tags = $request->input('tags', []);
        $languages = $request->input('languages', []);

        $query = Repository::query()->with(['tags', 'languages']);

        if (!empty($tags)) {
            $query->withCount([
                'tags as matching_tags_count' => function ($q) use ($tags) {
                    $q->whereIn('tags.id', $tags);
                }
            ]);
        }

        if (!empty($languages)) {
            $query->withCount([
                'languages as matching_languages_count' => function ($q) use ($languages) {
                    $q->whereIn('languages.id', $languages);
                }
            ]);
        }

        if (!empty($tags) && !empty($languages)) {
            $query->where(function ($q) use ($tags, $languages) {
                $q->whereHas('tags', function ($q) use ($tags) {
                    $q->whereIn('tags.id', $tags);
                })->orWhereHas('languages', function ($q) use ($languages) {
                    $q->whereIn('languages.id', $languages);
                });
            });
        } elseif (!empty($tags)) {
            $query->whereHas('tags', function ($q) use ($tags) {
                $q->whereIn('tags.id', $tags);
            });
        } elseif (!empty($languages)) {
            $query->whereHas('languages', function ($q) use ($languages) {
                $q->whereIn('languages.id', $languages);
            });
        }

        $repositories = $query->get();

        foreach ($repositories as $repo) {
            $repo->matching_tags_count = $repo->matching_tags_count ?? 0;
            $repo->matching_languages_count = $repo->matching_languages_count ?? 0;
            $repo->total_matches = $repo->matching_tags_count + $repo->matching_languages_count;
        }

        $repositories = $repositories->sortByDesc('total_matches')->values();

        return response()->json($repositories);
    }


    public function getOne(string $repositoryId) {
        
        $repository = Repository::where('id', $repositoryId)->with('languages')->with('tags')->first();
 
        return response()
            ->json($repository);
    }
}
