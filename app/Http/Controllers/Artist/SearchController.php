<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            Validator::validate($request->all(), [
                'search' => 'required|string'
            ]);

            $searchInput = $request->get('search');

            $artists = Artist::search($searchInput)->get()->pluck('name');

            return response()->json([
                'status' => 200,
                'data' => $artists
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'error' => $exception->getMessage()
            ], 500);
        }

    }
}
