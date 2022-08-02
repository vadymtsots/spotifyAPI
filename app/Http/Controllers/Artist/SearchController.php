<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        Validator::validate($request->all(), [
            'search' => 'required|string'
        ]);

        $searchInput = $request->get('search');

        return Artist::search($searchInput)->get()->pluck('name');
    }
}
