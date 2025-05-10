<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function search(Request $request)
    {
 
        return response()
            ->json($request);
    }    
}
