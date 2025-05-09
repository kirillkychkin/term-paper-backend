<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TagCategory;

class TagCategoryController extends Controller
{
    public function getAll()
    {
        $tagCategories = TagCategory::all();
 
        return response()
            ->json($tagCategories);
    }        

    public function getOne(string $tagCategoryId)
    {
        $tagCategory = TagCategory::where('id', $tagCategoryId)->first();
 
        return response()
            ->json($tagCategory);
    }    

    public function getTags(string $tagCategoryId)
    {
        $tagCategory = TagCategory::where('id', $tagCategoryId)->first();
        $tags = $tagCategory->tags;
 
        return response()
            ->json($tags);
    }
}
